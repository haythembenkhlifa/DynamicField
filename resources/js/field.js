Nova.booting((Vue, router, store) => {
  Vue.component('index-dynamic-field', require('./components/IndexField'))
  Vue.component('detail-dynamic-field', require('./components/DetailField'))
  Vue.component('form-dynamic-field', require('./components/FormField'))
})
