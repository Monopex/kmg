import Vue from 'vue'
import axios from 'axios'

const client = axios.create({
  baseURL: process.env.BACKEND_ADDRESS + 'api/',
  json: true
})

export default {

  async execute(method, resource, data, headers = {}) {
    return client({
      crossdomain: true,
      headers: headers,
      method,
      url: resource,
      data
    }).then(
      (response) => { return response.data },
      (error) => {
        if (process.env.SHOW_API_ERRORS) {
          // eslint-disable-next-line no-console
          console.log('Ошибка в запросе по пути ' + resource + ' | status: ' + error.request.status)
        }
      }
    )
  },

  /**
   * Авторизация
   * @param values
   * @returns {Promise<*>}
   */
  lists(values) {
    return this.execute('post', '/v1/lists', (values), { 'TOKEN': Vue.prototype.$realToken() })
  },

}
