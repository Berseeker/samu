<template>
  <div class="w-full mb-4 animate__animated animate__fadeInUp">
    <div
      class="bg-gray-100 rounded flex p-4 h-full items-center border-l-4 border-red-400"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        class="text-red-500 w-6 h-6 flex-shrink-0 mr-4"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
        />
      </svg>
      <span class="title-font font-medium">{{ msg }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "AlertComponent",
  props: {
    msg: {
      required: true,
      type: String,
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
