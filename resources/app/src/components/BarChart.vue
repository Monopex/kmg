<script>
import { Bar } from "vue-chartjs";
export default {
  name: "BarChart",
  extends: Bar,
  data: () => ({
    chartdata: {
      labels: ["AA", "BB", "CC"],
      datasets: [
        {
          label: "Q жидкости",
          backgroundColor: "#35c9bd",
          data: [40, 30, 12],
        },
        {
          label: "Плотность нефти",
          backgroundColor: "#333",
          data: [12, 20, 30],
        },
        {
          label: "Обводненность",
          backgroundColor: "#55c9f4",
          data: [20, 20, 17],
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
