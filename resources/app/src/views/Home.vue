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
        :disabled="loading"
      ></v-select>
      <v-select
        v-model="filter.deposit"
        :items="lists.deposit"
        item-text="title"
        item-value="id"
        label="Выберите месторождение"
        class="ma-2 max_select_width"
        dense
        outlined
        clearable
        hide-details
        :disabled="loading"
      ></v-select>
      <v-select
        v-model="filter.borehole_type"
        :items="lists.borehole_type"
        item-text="type"
        item-value="type"
        label="Выберите тип скважины"
        class="ma-2 max_select_width"
        dense
        outlined
        clearable
        hide-details
        :disabled="loading"
      ></v-select>
      <v-select
        v-model="filter.borehole_condition"
        :items="lists.borehole_condition"
        item-text="condition"
        item-value="condition"
        label="Выберите состояние"
        class="ma-2 max_select_width"
        dense
        outlined
        clearable
        hide-details
        :disabled="loading"
      ></v-select>
      <v-autocomplete
        v-model="filter.borehole"
        :items="lists.borehole_names"
        item-text="title"
        item-value="id"
        item-disabled="disabled"
        label="Выберите скважину"
        class="ma-2 max_select_width"
        dense
        multiple
        outlined
        clearable
        hide-details
        :disabled="loading || loaded"
        no-data-text="Значение не найдено"
        @change="borehole_limit(5)"
      ></v-autocomplete>

      <v-btn
        v-if="!loaded"
        class="ma-2"
        small
        @click="show_filter()"
        :loading="loading"
        :disabled="loading"
        ><v-icon>mdi-plus</v-icon>Показать</v-btn
      >
      <v-btn
        v-if="loaded"
        class="ma-2"
        small
        @click="clear_loaded_data()"
        :disabled="loading"
        ><v-icon>mdi-close</v-icon>Отмена</v-btn
      >
      <v-btn
        v-if="loaded && filter.saved"
        class="ma-2"
        small
        :loading="loading"
        :disabled="loading"
        @click="save()"
        ><v-icon>mdi-check</v-icon>Сохранить изменения</v-btn
      >
      <v-btn
        v-if="loaded && !filter.saved"
        class="ma-2"
        small
        @click="save()"
        :loading="loading"
        :disabled="loading"
        ><v-icon>mdi-check</v-icon>Сохранить</v-btn
      >
      <v-btn
        v-if="loaded && filter.saved"
        class="ma-2"
        small
        :loading="loading"
        :disabled="loading"
        @click="delete_list()"
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
              <template v-for="item in datasource">
                <tr v-if="filter_item(item)" :key="'item_' + item.id">
                  <td>
                    {{ item.deposit.title }}
                    <v-icon
                      v-if="filter.deposit == item.deposit.id"
                      color="green"
                      >mdi-check</v-icon
                    >
                  </td>
                  <td>{{ item.title }}</td>
                  <td>
                    <v-text-field
                      v-model="item.type"
                      class="max_input_text_width"
                    />
                  </td>
                  <td>
                    <v-text-field
                      v-model="item.condition"
                      class="max_input_text_width"
                    />
                  </td>
                  <td>
                    <v-select
                      v-model="item.level.id"
                      :items="lists.level"
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
              </template>
            </tbody>
          </template>
        </v-simple-table>
      </v-form>
    </v-col>
    <v-col v-if="char_visible" cols="6">
      <pie-chart chart-id="pie1" :datas="char.pie" />
    </v-col>
    <v-col v-if="char_visible" cols="6">
      <bar-chart chart-id="bar1" :datas="char.bar" />
    </v-col>
  </v-row>
</template>

<script>
import { mapActions } from "vuex";

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
    loading: false,
    loaded: false,
    char: [],
    char_visible: false,
    filter: {
      saved: true,
      borehole: [],
      deposit: null,
      borehole_type: null,
      borehole_condition: null,
    },
    datasource: [],
    borehole_counter: {
      props: {
        max: 2,
      },
    },
    lists: {
      deposit: [],
      borehole_type: [],
      borehole_condition: [],
      borehole_names: [],
      level: [],
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
    levels: [],
  }),
  async created() {
    this.loading = true;
    let response = await this.get_dropdown_lists({
      filter: [
        "deposit",
        "level",
        "borehole_type",
        "borehole_condition",
        "borehole_names",
      ],
    });
    this.apply_list(response);
    this.levels_gen();
    this.loading = false;
  },
  methods: {
    ...mapActions({
      get_dropdown_lists: "Field/GET_LISTS",
      get_filter: "Field/GET_FILTER",
      remove_field: "Field/REMOVE",
      save_field: "Field/SAVE",
      chars: "Field/CHARS",
    }),
    apply_list(list) {
      for (const key in list) {
        this.$set(this.lists, key, list[key]);
      }
    },
    filter_item(item) {
      let response = true;
      if (this.filter.saved != item.saved) response = false;
      if (
        this.filter.borehole_type != null &&
        this.filter.borehole_type != item.type
      )
        response = false;
      if (
        this.filter.borehole_condition != null &&
        this.filter.borehole_condition != item.condition
      )
        response = false;
      item.status = response;
      return response;
    },
    levels_gen() {
      let lvl = [];
      this.lists.level.forEach((element) => {
        lvl[element.id] = element.coefficient;
      });
      this.$set(this, "levels", lvl);
    },
    get_oil_flow_rate(item) {
      return (
        parseFloat(item.q_liquids) *
        (1 - parseFloat(item.water_cut) / 100) *
        parseFloat(item.oil_density) *
        parseFloat(this.levels[item.level.id])
      ).toFixed(2);
    },
    borehole_limit(count) {
      let count_matches = this.filter.borehole.length == count;
      this.lists.borehole_names.forEach((element) => {
        element.disabled = false;
        if (count_matches) {
          if (!this.filter.borehole.includes(element.id)) {
            element.disabled = true;
          }
        }
      });
    },
    async delete_list() {
      this.loaded = false;
      await this.remove_field({
        list: this.get_clear_status_list(),
      });
      this.char_visible = false;
      this.show_filter();
      this.$notify({
        group: "all",
        type: "success",
        title: "Успешно удалено",
      });
      this.loaded = true;
    },
    get_clear_status_list() {
      let response = [];
      this.datasource.forEach((element) => {
        if (element.status == true) {
          response.push(element);
        }
      });
      return response;
    },
    async show_filter() {
      if (this.filter.borehole.length == 0) {
        this.$notify({
          group: "all",
          type: "error",
          title: "Ошибка",
          text: "Ошибка веберите скважину",
        });
        return;
      }
      this.loading = true;
      let response = await this.get_filter(this.filter);
      this.$set(this, "datasource", response);
      this.loaded = true;
      this.loading = false;
    },
    async save() {

      if (!this.$refs.table_form.validate()) {
        this.$notify({
          group: "all",
          type: "error",
          title: "Внимание",
          text: "Ошибка сохранения",
        });
        return;
      }
      this.loading = true;
      await this.save_field({
        list: this.get_clear_status_list(),
      });
      let response = await this.get_dropdown_lists({
        filter: [
          "borehole_type",
          "borehole_condition",
        ],
      });
      this.apply_list(response);
      this.show_filter();
      let char = await this.chars();
      this.$set(this, 'char', char);
      this.char_visible = true;
      this.loading = false;
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
      this.$set(this, "filter", {
        saved: true,
        borehole: [],
        deposit: null,
        borehole_type: null,
        borehole_condition: null,
      });
      this.borehole_limit(5);
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
.max_input_text_width {
  max-width: 200px;
}
</style>
