<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8  my-5">
                <div class="card">
                    <div class="card-header">Create Guest</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mx-auto">
                                <form>
                                    <div class="form-group">
                                        <div v-if="output" class="alert alert-success">
                                            {{ output }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" v-model="first_name"  class="form-control" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" v-model="last_name"  class="form-control" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" v-model="email"  class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" min="0" v-model="phone" class="form-control" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                       <div class="form-check">
                                            <input class="form-check-input" type="radio" v-model="gender" id="gender1" value="0" checked>
                                            <label class="form-check-label" for="gender1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" v-model="gender" id="gender2" value="1">
                                            <label class="form-check-label" for="gender2">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" v-model="address" class="form-control" placeholder="Address">
                                    </div>
                                    <div class="text-center ">
                                        <button @click="formSubmit" class=" btn btn-primary">Create Booking</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
              first_name: null,
              last_name: null,
              email: null,
              phone: null,
              gender: null,
              address: null,
              output: null
            };
        },
        methods: {
            formSubmit(e) {

                 axios.post('/create', {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    phone: this.phone,
                    gender: this.gender,
                    address: this.address
                })
                .then((res) => {
                    this.output = "Successfuly Submitted!";
                    this.first_name = null;
                    this.last_name = null;
                    this.email = null;
                    this.phone = null;
                    this.address = null;
                })
                .catch(err => console.log(err));

                e.preventDefault();
            }
        }
    }
</script>
