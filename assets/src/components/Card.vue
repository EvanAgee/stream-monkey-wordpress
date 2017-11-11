<template>
  <router-link :to="'/'+type+'/'+src.id" class="card">
    <div class="card--top">
      <img :src="src.images['360x203']" />
    </div>
    <div class="card--bottom">
      <h4 class="card--title" v-html="src.title"></h4>
      <!-- <div v-if="src.description" class="card--body">{{ src.description | truncate(80) }}</div> -->
    </div>
  </router-link>
</template>

<script>
export default {
  props: ["src", "type"]
}
</script>

<style lang="scss">
.card {
  font-size: .9rem;
  position: relative;
  display: flex;
  line-height: 1.2;
  flex-direction: column;
  background-color: #f1f1f1;
  color: #3b3b42;
  min-height: 100px;
  border-radius: 3px;
  overflow: hidden;
  border-bottom: 3px solid #e5e5e5;

  &--top {

  }

  &--bottom {
    flex: 1;
    flex-grow: 1;
    padding: 1rem;
  }

  &--title {
    font-size: .9rem;
    margin: 0;
    font-weight: 600;
    line-height: 1.2;
    text-transform: uppercase;
  }

  &--body {
    color: #3b3b42;
    padding-top: .75rem;
  }

  &:hover {
    border-color: #ac162c;
  }
}
</style>
