<template>
  <div class="row">
    <CardsComponent/>
  </div>
</template>

<script>
import CardsComponent from './CardsComponent';
export default {
  components: {
    CardsComponent,
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>

<style lang="stylus" scoped></style>