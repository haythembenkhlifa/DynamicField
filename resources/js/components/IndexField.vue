<template>
    <div class="w-3/4 py-4 break-words" style="display: flex;">
        <span v-show="showAnimation && !stop" class="mr-3 text-60">
            <svg viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor"  style="width: 30px;"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg>
        </span>
        <p>{{value}}</p>
    </div>
</template>

<script>
export default {
  props: ["resource", "resourceName", "resourceId", "field", "callEvery","markAsDone","defaultValue"],
  data() {
    return {
      value: "__",
      show: true,
      stop:false,
      showAnimation:false,
    };
  },
  methods: {
    getFieldValue() {
      axios
        .get(this.field.endPoint)
        .then((response) => {

          this.stop = response.data.stop;
          this.show = response.data.show;

          if (this.stop == false) {
            this.value = response.data.value;
            this.showAnimation = response.data.showAnimation;
          }

        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    setFieldValue() {
      setInterval(() => {
        if (!this.stop) {
          this.getFieldValue();
        }
      }, this.field.callEvery);
    },

  },
  mounted() {

    if (this.field.markAsDone == true) {
            this.showAnimation = false;
            this.stop = true;
            this.value = this.field.defaultValue;
    }
    else
    {
        this.setFieldValue();
    }


  },
};
</script>
