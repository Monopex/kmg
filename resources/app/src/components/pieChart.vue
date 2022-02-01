<script>
import { Pie } from "vue-chartjs";
export default {
  name: "PieChart",
  extends: Pie,
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
