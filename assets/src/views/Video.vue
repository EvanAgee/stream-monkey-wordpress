<template>
  <div class="video-wrapper">
    <router-link to="/" class="sc_button sc_button_square sc_button_style_filled sc_button_size_small"><i class="fa fa-angle-left"></i>&nbsp;&nbsp; Back to Sermons</router-link>

    <template v-if="video">
      <div class="player">
        <iframe v-if="video" class="stream-iframe" :src="'//player.streammonkey.com/iframe/'+video.id"></iframe>
      </div>

      <div class="video-details">
        <h2 clss="video-details--title" v-html="video.title"></h2>
        <div class="video-details--date">{{ video.date | formatDate }}</div>
        <p class="video-details--description"v-html="video.description"></p>
      </div>

      <template v-if="video.series">
      <hr>
      <div class="sermon-center--section">
        <h3 class="sermon-center--section--header">Videos In This Series</h3>
        <slick class="slick-series" v-if="video.series.videos.length > 0" ref="slick" :options="slickOptions">
          <div v-for="video in video.series.videos">
            <card :src="video" type="video"></card>
          </div>
        </slick>
      </div>
      </template>  
    </template>
    <template v-else>
    <div>
      Loading...
    </div>
    </template>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import mixinGlobal from '../mixins/global'
import Slick from 'vue-slick'
import Card from '../components/Card.vue'

export default {
  mixins: [mixinGlobal],
  data() {
    return {
      video: null
    }
  },

  computed: {
    ...mapGetters([
      "getVideo",
      "recentMessageDataLoaded"
    ])
  },

  methods: {
    ...mapActions([
      'getRecentMessages',
    ]),
  },
  
  mounted() {
    this.video = this.getVideo(this.$route.params.id)
  },

  beforeMount() {
    this.getRecentMessages()
  },
  
  watch: {
    recentMessageDataLoaded() {
      this.video = this.getVideo(this.$route.params.id)
    },

    video() {
      this.equalizeCards()
    }
  },

  components: {
    Slick,
    Card
  }
}
</script>

<style lang="scss" scoped>
.sc_button {
  margin-bottom: 1rem;
}

.video-wrapper {
}

.player {
  height: 0;
  overflow: hidden;
  padding: 0 0 56.25%;
  position: relative;
}

.stream-iframe {
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}

.video-details {
  &--title {

  }

  &--date {
    font-style: italic;
  }

  &--description {
    margin-top: 2rem;
  }
}
</style>