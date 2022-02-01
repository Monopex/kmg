<script>
import { Bar } from "vue-chartjs";
export default {
  name: "BarChart",
  extends: Bar,
  props: {
   datas: Array,
  },
  data: () => ({
    chartdata: {
      labels: [],
      datasets: [],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
    },
  }),
  mounted() {
    this.$set(this, 'chartdata', this.datas);
    this.renderChart(this.chartdata, this.options);
  },
};
</script>
