<script>
import VueCharts from "vue-chartjs";
import { Bar } from "vue-chartjs";

export default {
  extends: Bar,
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
    chartdata: {
      type: Object,
      default: null
    },
    options: {
      type: Object,
      default: null
    },
  },
  mounted() {
    this.renderChart({labels:this.chartdata.labels, datasets: [{label:'Products',backgroundColor: "#f87979", data:this.chartdata.data}]}, {responsive: true, maintainAspectRatio: false});
  },
};
</script>

<style>
</style>