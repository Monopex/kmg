<template>
  <v-row>
    <v-col class="d-flex align-center flex-wrap pa-6">
      <v-select
        v-model="filter.saved"
        :items="lists.saved"
        item-text="title"
        item-value="value"
        label="Статус"
        class="ma-2 max_select_width"
        dense
        outlined
        hide-details
      ></v-select>
      <v-select
        :items="lists.borehole"
        item-text="title"
        item-value="id"
        label="Выберите месторождение"
        class="ma-2 max_select_width"
        dense
        outlined
        hide-details
      ></v-select>
      <v-select
        :items="lists.borehole"
        item-text="title"
        item-value="id"
        label="Выберите тип скважины"
        class="ma-2 max_select_width"
        dense
        outlined
        hide-details
      ></v-select>
      <v-select
        :items="lists.borehole"
        item-text="title"
        item-value="id"
        label="Выберите состояние"
        class="ma-2 max_select_width"
        dense
        outlined
        hide-details
      ></v-select>
      <v-autocomplete
        v-model="filter.borehole"
        :items="lists.borehole"
        item-text="title"
        item-value="id"
        item-disabled="disabled"
        label="Выберите скважину"
        class="ma-2 max_select_width"
        dense
        multiple
        outlined
        hide-details
        no-data-text="Значение не найдено"
        @change="borehole_limit(5)"
      ></v-autocomplete>

      <v-btn v-if="!loaded" class="ma-2" small
        ><v-icon>mdi-plus</v-icon>Показать</v-btn
      >
      <v-btn v-if="loaded" class="ma-2" small @click="clear_loaded_data()"
        ><v-icon>mdi-close</v-icon>Отмена</v-btn
      >
      <v-btn v-if="loaded && filter.saved" class="ma-2" small
        ><v-icon>mdi-check</v-icon>Сохранить изменения</v-btn
      >
      <v-btn v-if="loaded && !filter.saved" class="ma-2" small @click="save()"
        ><v-icon>mdi-check</v-icon>Сохранить</v-btn
      >
      <v-btn v-if="loaded && filter.saved" class="ma-2" small
        ><v-icon>mdi-close</v-icon>Удалить</v-btn
      >
    </v-col>
    <v-col cols="12">
      <v-form ref="table_form">
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">Месторождение</th>
                <th class="text-left">Скважина</th>
                <th class="text-left">Тип скважины</th>
                <th class="text-left">Состояние скважины</th>
                <th class="text-left">Горизонт</th>
                <th class="text-left">Q жидкости</th>
                <th class="text-left">Обводненность</th>
                <th class="text-left">Плотность нефти</th>
                <th class="text-left">Дебит нефти</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in datasource" :key="'item_' + item.id">
                <td>{{ item.deposit }}</td>
                <td>{{ item.borehole }}</td>
                <td>{{ item.borehole_type }}</td>
                <td>{{ item.borehole_condition }}</td>
                <td>
                  <v-select
                    v-model="item.level"
                    :items="lists.levels"
                    item-text="title"
                    item-value="id"
                    dense
                    hide-details
                    class="max_input_width"
                  ></v-select>
                </td>
                <td>
                  <v-text-field
                    v-model="item.q_liquids"
                    v-mask="doubleMask"
                    class="max_input_width"
                    :rules="[double_empty]"
                  />
                </td>
                <td>
                  <v-text-field
                    v-model="item.water_cut"
                    v-mask="doubleMask"
                    class="max_input_width"
                    :rules="[double_empty]"
                  />
                </td>
                <td>
                  <v-text-field
                    v-model="item.oil_density"
                    v-mask="doubleMask"
                    class="max_input_width"
                    :rules="[double_empty]"
                  />
                </td>
                <td>{{ get_oil_flow_rate(item) }}</td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-form>
    </v-col>
    <v-col v-if="char_visible" cols="6">
      <pie-chart chart-id="pie1" />
    </v-col>
    <v-col v-if="char_visible" cols="6">
      <bar-chart chart-id="bar1" />
    </v-col>
  </v-row>
</template>

<script>
import pieChart from "@/components/pieChart.vue";
import BarChart from "@/components/BarChart.vue";

export default {
  name: "Home",
  data: () => ({
    doubleMask: {
      mask: "dddddd",
      tokens: {
        d: { pattern: /[0-9.]/ },
      },
    },
    loaded: true,
    char_visible: false,
    filter: {
      saved: true,
      borehole: [],
    },
    datasource: [
      {
        id: 1,
        deposit: "АА",
        borehole: "10Д",
        borehole_type: "добывающая",
        borehole_condition: "Наблюдательная",
        level: 5, // Гозизонт
        q_liquids: 11.6,
        water_cut: 88.6, // Обводненность
        oil_density: 0.83, // Плотность нефти
      },
      {
        id: 2,
        deposit: "АА",
        borehole: "10Д",
        borehole_type: "добывающая",
        borehole_condition: "Наблюдательная",
        level: 5, // Гозизонт
        q_liquids: 11.6,
        water_cut: 88.6, // Обводненность
        oil_density: 0.83, // Плотность нефти
      },
    ],
    borehole_counter: {
      props: {
        max: 2,
      },
    },
    lists: {
      borehole: [
        {
          id: 1,
          title: "AA",
          disabled: false,
        },
        {
          id: 2,
          title: "BB",
          disabled: false,
        },
        {
          id: 3,
          title: "CC",
          disabled: false,
        },
      ],
      levels: [
        {
          id: 1,
          title: "I",
        },
        {
          id: 2,
          title: "II",
        },
        {
          id: 3,
          title: "III",
        },
        {
          id: 4,
          title: "IV",
        },
        {
          id: 5,
          title: "V",
        },
      ],
      saved: [
        {
          value: true,
          title: "Сохранено",
        },
        {
          value: false,
          title: "Не сохранено",
        },
      ],
    },
    levels1: [
      {
        key: "I",
        val: 0.01,
      },
      {
        key: "II",
        val: 0.03,
      },
      {
        key: "III",
        val: 0.05,
      },
      {
        key: "IV",
        val: 0.01,
      },
      {
        key: "V",
        val: 0.03,
      },
    ],
    levels: {
      1: 0.01,
      2: 0.03,
      3: 0.05,
      4: 0.01,
      5: 0.03,
    },
  }),
  methods: {
    get_oil_flow_rate(item) {
      if (!item.q_liquids) item.q_liquids = 0;
      if (!item.water_cut) item.water_cut = 0;
      if (!item.oil_density) item.oil_density = 0;

      return (
        parseFloat(item.q_liquids) *
        (1 - parseFloat(item.water_cut) / 100) *
        parseFloat(item.oil_density) *
        parseFloat(this.levels[item.level])
      ).toFixed(2);
    },
    borehole_limit(count) {
      let count_matches = this.filter.borehole.length == count;
      this.lists.borehole.forEach((element) => {
        element.disabled = false;
        if (count_matches) {
          if (!this.filter.borehole.includes(element.id)) {
            element.disabled = true;
          }
        }
      });
    },
    save() {
      if (!this.$refs.table_form.validate()) {
        this.$notify({
          group: "all",
          type: "error",
          title: "Внимание",
          text: "Ошибка сохранения",
        });
        return;
      }
      this.$notify({
        group: "all",
        type: "success",
        title: "Успешно сохранено",
      });
    },
    clear_loaded_data() {
      this.loaded = false;
      this.char_visible = false;
      this.$set(this, "datasource", []);
    },
    double_empty(v) {
      if (v) {
        return /^\d+(\.\d{1,2})?$/.test(v) || "Некорректно";
      } else {
        return "Поле обязательно для заполнения";
      }
    },
  },
  components: { pieChart, BarChart },
};
</script>
<style scoped>
.max_input_width {
  width: 75px;
}
.max_select_width {
  max-width: 250px;
}
</style>
