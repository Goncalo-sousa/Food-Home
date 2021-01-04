<template>
  <div class="container">
    <h3>Type of Products</h3>
    <BarChart v-if="loaded" :chartdata="chartdata" :options="options" />
    <LineChart v-if="loaded" :chartdataOrders="chartdataOrders" :options="options" />
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
  data: () => ({
    loaded: false,
    chartdata: null,
    chartdataOrders: null,
    options: null,
  }),
  async mounted() {
    this.loaded = false;
    await axios.get("/api/statistics").then((response) => {
      this.chartdata = response.data;
      this.loaded = true;
      console.log(this.chartdata);
    });
    await axios.get("/api/statisticsOrders").then((response) => {
      this.chartdataOrders = response.data;
      this.loaded = true;
      console.log(this.chartdataOrders);
    });
  },
};
</script>

<style>
</style>