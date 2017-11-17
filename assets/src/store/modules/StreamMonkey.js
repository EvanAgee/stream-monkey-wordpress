import * as types from '../mutations'

let APIRoot = streamMonkeySettings.streammonkey_api_base + streamMonkeySettings.streammonkey_channel_id

// initial state
const state = {
  loaded: false,
  baseDataLoaded: false,
  recentMessageDataLoaded: false,
  channelData: false,
  recentMessages: [],
  series: []
}

// getters
const getters = {
  channelData: state => state.channelData,

  recentMessages: state => state.recentMessages,

  series: state => state.series,

  getVideo: state => (videoID) => {
    if ( !_.isEmpty(state.recentMessages) ) {
      let video = _.find(state.recentMessages, { 'id': videoID })

      _.each(state.series, series => {
        if ( _.find(series.videos, { id: videoID }) ) {
          video.series = series
          return true
        }
      })

      return video
    }
    return false
  },

  getSeries: state => (seriesID) => {
    return !_.isEmpty(state.series) ? _.find(state.series, { id: seriesID }) : false
  },
  recentMessageDataLoaded: state => state.recentMessageDataLoaded,
  baseDataLoaded: state => state.baseDataLoaded
}

// actions
const actions = {
  getStreamMonkeyData({commit, dispatch, getters}) {
    axios.get(APIRoot)
      .then(function (response) {
        commit(types.STORE_FETCHED_DATA, response.data)
        commit(types.UPDATE_LOADED_DATA, { key: "baseDataLoaded", value: true })

        let series = _.first(response.data.categories.filter(cat => cat.id === streamMonkeySettings.streammonkey_series_id)).playlists

        _.each(series, s => {
          dispatch('getSeriesData', s.id)
        })
      })
      .catch(function (error) {
        console.log(error)
      });
  },

  getRecentMessages({ commit }) {
    axios.get(APIRoot + '/' + streamMonkeySettings.streammonkey_recent_messages_id)
      .then(function (response) {
        commit(types.STORE_RECENT_MESSAGES, response.data.videos)
        commit(types.UPDATE_LOADED_DATA, { key: "recentMessageDataLoaded", value: true })
      })
      .catch(function (error) {
        console.log(error)
      });
  },

  getSeriesData({commit}, seriesID) {
    axios.get(APIRoot + '/' + seriesID)
    .then(function (response) {
      commit(types.STORE_SERIES_DATA, response.data)
    })
    .catch(function (error) {
      console.log(error)
    });
  }
}

// mutations
const mutations = {
  [types.STORE_FETCHED_DATA](state, payload) {
    state.channelData = payload
  },

  [types.STORE_RECENT_MESSAGES](state, payload) {
    state.recentMessages = payload
  },

  [types.UPDATE_LOADED_DATA](state, payload) {
    state[payload.key] = payload.value
  },

  [types.STORE_SERIES_DATA](state, payload) {
    state.series.push(payload)
  },

  [types.STORE_SERIES_DATA](state, payload) {
    if ( !_.find(state.series, { id: payload.id }) ) {
      state.series.push(payload)
    }

    state.series = _.sortBy(state.series, ['date']).reverse()
  },
}

export default {
  state,
  getters,
  actions,
  mutations
}