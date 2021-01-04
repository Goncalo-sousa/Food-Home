<template>
  <div class="container">
    <BarChart v-if="loaded" :chartdata="chartdata" :options="options" />
    <LineChart v-if="loaded" :chartdata="chartdata" :options="options" />

  </div>
</template>

<script>
import VueCharts from "vue-chartjs";
import BarChart from "./BarChart.vue";
import LineChart from "./LineChart.vue";
export default {
  name: "Statistics",
  components: {
    BarChart,
    LineChart,
  },
  // data() {
  //   return {
  //     chartData: {
  //       Books: 24,
  //       Magazine: 30,
  //       Newspapers: 10,
  //     },
  //     products: {
  //       data:[],
  //       month:[],
  //     },
  //   };
  // },
  data: () => ({
    loaded: false,
    chartdata: null,
    options: null,
  }),
  async mounted() {
    this.loaded = false;
    await axios.get("/api/statistics").then((response) => {
      this.chartdata = response.data;
      this.loaded = true;
      console.log(this.chartdata);
    });
  },
};
</script>

<style>
</style>