<script>
import VueCharts from "vue-chartjs";
import { Line } from "vue-chartjs";

export default {
  extends: Line,
  // props: ["products"],
  // mounted() {
  //   console.log(this.products);
  //   this.renderChart(
  //     {
  //       labels: this.products.month,
  //       datasets: [
  //         {
  //           label: "Data One",
  //           backgroundColor: "#f87979",
  //           data: this.products.data,
  //         },
  //       ],
  //     },
  //     { responsive: true, maintainAspectRatio: false }
  //   );
  // },
  props: {
    chartdataOrders: {
      type: Object,
      default: null
    },
    options: {
      type: Object,
      default: null
    },
  },
  mounted() {
    this.renderChart({labels:this.chartdataOrders.label, datasets: [{label:'Orders',backgroundColor: "#f87979", data:this.chartdataOrders.data}]}, {responsive: true, maintainAspectRatio: false});
  },
};
</script>

<style>
</style>