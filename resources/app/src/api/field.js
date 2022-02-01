import axios from 'axios'

const client = axios.create({
  baseURL: process.env.VUE_APP_BACKEND_ADDRESS + 'api/',
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
        if (process.env.VUE_APP_SHOW_API_ERRORS) {
          // eslint-disable-next-line no-console
          console.log('Ошибка в запросе по пути ' + resource + ' | status: ' + error.request.status)
        }
      }
    )
  },

  lists(values) {
    return this.execute('post', '/dropdown/lists', values)
  },

  filter(values) {
    return this.execute('post', '/borehole/filter', values)
  },

  remove(values) {
    return this.execute('post', '/borehole/remove', values)
  },

  save(values) {
    return this.execute('post', '/borehole/save', values)
  },

  chars(values) {
    return this.execute('post', '/borehole/chars', values)
  },

}
