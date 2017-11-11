<template>
  <div class="series-wrapper">
    <div class="vc_row">
      <div class="vc_col-md-12">
        <router-link to="/" style="margin-bottom: 2rem;" class="sc_button sc_button_square sc_button_style_filled sc_button_size_small"><i class="fa fa-angle-left"></i>&nbsp;&nbsp; Back to Sermons</router-link>
      </div>
    </div>

    <template v-if="baseDataLoaded && theSeries">
      <div class="vc_row">
        <div class="vc_col-md-4">
          <img :src="theSeries.images['360x203']" />
        </div>
        <div  class="vc_col-md-8">
          <h2 v-html="theSeries.title"></h2>
          <p v-html="theSeries.description"></p>
        </div>
      </div>

      <div class="vc_row">
        <div class="vc_col-md-12">
          <hr>
          <div class="sermon-center--section">
            <h3 class="sermon-center--section--header">Videos In This Series</h3>
            <slick class="slick-series" v-if="theSeries.videos.length > 0" ref="slick" :options="slickOptions">
              <div v-for="video in theSeries.videos">
                <card :src="video" type="video"></card>
              </div>
            </slick>
          </div>
        </div>
      </div>
    </template>
    <template v-else>
      Loading...
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
    }
  },

  computed: {
    ...mapGetters([
      "baseDataLoaded",
      "getSeries"
    ]),

    theSeries() {
      return this.getSeries(this.$route.params.id)
    }
  },

  methods: {
    ...mapActions([
      'getStreamMonkeyData',
    ]),
  },

  created() {
    this.getStreamMonkeyData()
  },
  
  watch: {
  },

  components: {
    Slick,
    Card
  }
}
</script>