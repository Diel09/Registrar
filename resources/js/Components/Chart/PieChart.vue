<template>
  <Pie
    id="my-chart-id"
    :options="chartOptions"
    :data="chartData"
  />
</template>

<script>
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
  name: 'BarChart',
  components: { Pie },
  data() {
    return {
      chartData: {
        labels: ['Diploma', 'COE', 'Authentication', 'COG'],
        datasets: [
          {
            backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
            data: [80, 60, 40, 20]
          }
        ]
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false
      }
    }
  }
}
</script>