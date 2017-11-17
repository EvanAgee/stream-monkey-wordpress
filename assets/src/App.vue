<template>
  <div class="streamMonkey-wordpress">
    <router-view></router-view>
  </div>
</template>

<script>
import '../../node_modules/slick-carousel/slick/slick.css'
import '../../node_modules/slick-carousel/slick/slick-theme.css'
import { mapGetters, mapActions } from 'vuex'

export default {
  data () {
    return {

    }
  },

  methods: {
    ...mapActions([
      'getStreamMonkeyData',
      'getPlaylistData',
      'getRecentMessages'
    ]),
  },

  mounted() {
    this.getStreamMonkeyData()
    this.getRecentMessages()
  }
}
</script>

<style lang="scss">
.streamMonkey-wordpress {
  padding: 2rem 0;
}

.slick-list {
  margin-left: -.5rem;
  margin-right: -.5rem;
}

.slick-track {
  margin-left: 0;
}

.slick-slide {
  margin: 0 0.5rem;
}

.slick-dots {
  bottom: -43px;

  @media screen and (max-width: 600px) {
    bottom: -75px;
  }

  li button:hover {
    background: transparent;
  }
}

.slider-nav {
  position: absolute;
  display: block;
  padding: 0;
  transform: translateY(-50%);
  cursor: pointer;
  border: none;
  border-radius: 0;
  display: inline-block;
  padding: 0.5rem 1rem .6rem;

  z-index: 20;
  bottom: -67px;
  top: auto;

  &.slider-prev {
    left: 0;
  }

  &.slider-next {
    right: 0;
  }

  .fa {
    font-size: 20px;
  }
}

hr {
  border: 0;
  margin: 3rem 0;
  height: 3px;
  background-color: #e5e5e5;
}
</style>
