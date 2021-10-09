<template>
  <div class="loading">
    <img src="/img/blocks.gif" :width="size" :height="size" />
    <h5>Cargando...</h5>
  </div>
</template>

<script>
export default {
  name: "Loading",
  props: {
    size: String,
  },
};
</script>

<style lang="scss" scoped>
.loading {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}
</style>