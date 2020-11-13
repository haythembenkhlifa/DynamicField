<template>
    <div class="w-3/4 py-4 break-words" style="display: flex;">
        <span v-show="showAnimation && !stop" class="mr-3 text-60">
            <svg viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor"  style="width: 30px;"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg>
        </span>
        <span v-bind:class="myclass" v-bind:style="mystyle" >{{value}}</span>
    </div>
</template>

<script>
export default {
  props: ["resource", "resourceName", "resourceId", "field", "callEvery","markAsDone","defaultValue","badgesMap"],
  data() {
    return {
      value: "__",
      show: true,
      stop:false,
      showAnimation:false,
      badgesMapArray:[],
      listOfClasses:[],
      myclass:"",
      mystyle:""
    };
  },
  methods: {
    getFieldValue() {
      axios
        .get(this.field.endPoint)
        .then((response) => {
          //return response.data;
          this.setFieldClass();
          this.stop = response.data.stop;
          this.show = response.data.show;
          this.value = response.data.value;

          if (this.stop == false) {
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
            this.setFieldClass();
            this.getFieldValue();
        }
      }, this.field.callEvery);
    },
    setFieldClass()
    {

    if (this.field.badgesMap) {

        if ( this.listOfClasses[this.badgesMapArray[this.value]]) {
            this.myclass = this.listOfClasses[this.badgesMapArray[this.value]];
            this.mystyle="";
        }else
        {
            this.myclass = "px-2 py-1 rounded-full uppercase text-xs font-bold text-dark";
            this.mystyle="background-color:"+this.badgesMapArray[this.value]+";";
        }

    }

    }

  },
  mounted() {


    this.listOfClasses['primary']="bg-primary px-2 py-1 rounded-full uppercase text-xs font-bold text-white";
    // this.listOfClasses['secondary']="bg-secondary px-2 py-1 rounded-full uppercase text-xs font-bold text-white";
    this.listOfClasses['success']="bg-success px-2 py-1 rounded-full uppercase text-xs font-bold text-white";
    this.listOfClasses['danger']="bg-danger px-2 py-1 rounded-full uppercase text-xs font-bold text-white";
    this.listOfClasses['warning']="bg-warning px-2 py-1 rounded-full uppercase text-xs font-bold text-dark";
    this.listOfClasses['info']="bg-info px-2 py-1 rounded-full uppercase text-xs font-bold text-white";
    // this.listOfClasses['light']="bg-light-dark px-2 py-1 rounded-full uppercase text-xs font-bold text-dark";
    // this.listOfClasses['dark']="bg-dark px-2 py-1 rounded-full uppercase text-xs font-bold text-white";
    // this.listOfClasses['muted']="bg-muted px-2 py-1 rounded-full uppercase text-xs font-bold text-white";
    // this.listOfClasses['white']="bg-white px-2 py-1 rounded-full uppercase text-xs font-bold text-dark";

    if (this.field.badgesMap) {
        const resultObject = Array.of(JSON.parse(JSON.stringify(this.field.badgesMap)))[0];

            Object.keys(resultObject).map((field) => {
                this.badgesMapArray[field] = resultObject[field];
            });


    }

    if (this.field.markAsDone == true) {
            this.showAnimation = false;
            this.stop = true;
            this.value = this.field.defaultValue;
            this.setFieldClass();
    }
    else
    {
        this.setFieldValue();
    }

  },
};
</script>
