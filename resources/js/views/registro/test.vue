<template>
	

			
				

			<div class="row mt--2">
				<div class="col-md-8">
				<b-card no-body>
				  <b-tabs
				    active-nav-item-class="font-weight-bold text-uppercase text-danger"
				    active-tab-class="font-weight-bold text-success"
				    content-class="mt-3"
				    vertical
				  >
				    <b-tab title="First" active>
				    	

				    	<div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
        id="input-group-1"
        label="Email address:"
        label-for="input-1"
        description="We'll never share your email with anyone else."
      >
        <b-form-input
          id="input-1"
          v-model="form.email"
          type="email"
          required
          placeholder="Enter email"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your Name:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="form.name"
          required
          placeholder="Enter name"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="Food:" label-for="input-3">
        <b-form-select
          id="input-3"
          v-model="form.food"
          :options="foods"
          required
        ></b-form-select>
      </b-form-group>

      <b-form-group id="input-group-4">
        <b-form-checkbox-group v-model="form.checked" id="checkboxes-4">
          <b-form-checkbox value="me">Check me out</b-form-checkbox>
          <b-form-checkbox value="that">Check that out</b-form-checkbox>
        </b-form-checkbox-group>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card>
  </div>






				    </b-tab>
				    <b-tab title="Second"><p>I'm the second tab</p></b-tab>
				    <b-tab title="Disabled" disabled><p>I'm a disabled tab!</p></b-tab>
				  </b-tabs>
			  </b-card>
			</div>
			  <div class="col-md-4">
			  <b-card no-body>
			    <b-tabs pills card vertical nav-wrapper-class="w-50">
			      <b-tab title="Tab 1" active><b-card-text>Tab contents 1</b-card-text></b-tab>
			      <b-tab title="Tab 2"><b-card-text>Tab contents 2</b-card-text></b-tab>
			      <b-tab title="Tab 3"><b-card-text>Tab contents 3</b-card-text></b-tab>
			    </b-tabs>
			  </b-card>

			</div>
			</div>

		
</template>

<script>
  export default {
    data() {
      return {
        form: {
          email: '',
          name: '',
          food: null,
          checked: []
        },
        foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
        show: true
      }
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()
        alert(JSON.stringify(this.form))
      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.name = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }
  }
</script>
