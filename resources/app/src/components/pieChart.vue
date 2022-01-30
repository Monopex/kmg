<script>
import { Pie } from "vue-chartjs";
export default {
  name: "PieChart",
  extends: Pie,
  data: () => ({
    chartdata: {
      labels: ["AA", "BB", "CC"],
      datasets: [
        {
          backgroundColor: ["#41B883", "#E46651", "#00D8FF"],
          data: [40, 20, 80],
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
    },
  }),
  mounted() {
    this.renderChart(this.chartdata, this.options);
  },
};
</script>
