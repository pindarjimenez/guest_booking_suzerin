<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a class="btn btn-success float-right mb-3" href="/create" role="button">Create Booking</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(booking, index) in bookings" :key="index">
                            <td>{{ booking.id }}</td>
                            <td>{{ booking.first_name }}</td>
                            <td>{{ booking.last_name }}</td>
                            <td>{{ booking.email }}</td>
                            <td>{{ booking.phone }}</td>
                            <td>{{ booking.gender == 0 ? 'Male' : 'Female' }}</td>
                            <td>{{ booking.address }}</td>
                            <td>
                                <button @click="updateBooking(booking)" class="btn btn-primary">Update</button>
                                <button @click="deleteBooking(booking.id)" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Guest: </b>{{ first_name + ' ' + last_name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="submitBooking()" :disabled="!isComplete">Update changes</button>
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
                bookings: [],
                id: null,
                first_name: null,
                last_name: null,
                email: null,
                phone: null,
                gender: null,
                address: null,
            }
        },
        methods: {
            fetchBooking() {
                axios.get(`/get-bookings`).then((res) => {
                    if (typeof res.data != 'undefined') {
                        this.bookings = res.data;
                    } else {
                        this.bookings = [];
                    }
                }).catch(err => console.log(err));
            },
            deleteBooking(id) {
                axios.delete(`/booking/`+id).then(response => {
                    toastr.success('Successfully Deleted!');
                    this.fetchBooking();
                }).catch(err => console.log(err));
            },
            updateBooking(booking) {
                this.id = booking.id;
                this.first_name = booking.first_name;
                this.last_name = booking.last_name;
                this.email = booking.email; 
                this.phone = booking.phone;
                this.gender = booking.gender;
                this.address = booking.address;
                $('#update').modal('show');
            },
            submitBooking() {
                axios.post('/update', {
                    id: this.id,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    phone: this.phone,
                    gender: this.gender,
                    address: this.address
                })
                .then((res) => {
                    $('#update').modal('hide');
                    toastr.success('Successfully Updated!');
                    this.fetchBooking();
                })
                .catch(err => console.log(err));
            }
        },
        mounted() {
            this.fetchBooking();
        },
        computed: {
            isComplete () {
                return this.first_name && this.last_name && this.email && this.phone && this.address;
            }
        }
    }
</script>
