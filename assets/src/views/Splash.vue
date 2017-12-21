<template>
  <div>
    <div v-if="channelData.categories" class="sermon-center">

      <div class="sermon-center--section">
        <h3 class="sermon-center--section--header">Recent Messages</h3>
        <slick class="slick-recent" v-if="recentMessages.length > 0" ref="slick" :options="slickOptions">
          <div v-for="message in recentMessages">
            <card :src="message" type="video"></card>
          </div>
        </slick>
      </div>

      <div class="sermon-center--section">
        <h3 class="sermon-center--section--header">Series</h3>
        <slick class="slick-series" v-if="series.length > 0" ref="slick-series" :options="slickOptions">
          <div v-for="s in series">
            <card :src="s" type="series"></card>
          </div>
        </slick>
      </div>

    </div>
    <div v-else>Loading...</div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import mixinGlobal from '../mixins/global'
import Slick from 'vue-slick'
import Card from '../components/Card.vue'

export default {
  mixins: [mixinGlobal],
  data () {
    return {
    }
  },

  computed: {
    ...mapGetters([
      'channelData',
      'recentMessages',
      'series'
    ])
  },

  methods: {
    ...mapActions([
      'getStreamMonkeyData',
      'getRecentMessages'
    ]),

    reInit() {
      // Helpful if you have to deal with v-for to update dynamic lists
      this.$nextTick(() => {
        this.$refs.slick.reSlick()
      });
    },
  },

  mounted() {
    this.getStreamMonkeyData()
    this.getRecentMessages()
    let self = this
    window.onload = function(){
      setTimeout(self.reInit, 500)
    }
  },

  watch: {
    recentMessages(val) {
      if ( val.length > 0 ) {
        this.equalizeCards()
        this.$refs.slick.reSlick()
      }
    },

    series(val) {
      if ( val.length > 0 ) {
        this.equalizeCards()
        this.$refs.slick.reSlick()
      }
    }
  },

  components: {
    Slick,
    Card
  }
}
</script>

<style lang="scss">
.sermon-center {
  &--section {
    padding-bottom: 4rem;
    margin-bottom: 1rem;
    border-width: 3px 3px 3px 3px;
    border-radius: 0px 0px 0px 0px;
    border-color: #e5e5e5;
    border-bottom-style: solid;

    &--header {
      margin-bottom: 3rem;
    }

    &:last-child {
      border-bottom: 0;
    }
  }
}
</style>
