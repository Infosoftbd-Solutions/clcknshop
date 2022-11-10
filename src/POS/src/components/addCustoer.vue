<template>
  <section class="customer">
    <div v-if="customerModal">
      <transition name="model">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add customer</h4>
                  <button
                    type="button"
                    class="close"
                    @click="modal({ name: 'customerModal', show: false })"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                          <i class="fa fa-search"></i>
                        </span>
                      </div>
                      <input
                        type="text"
                        v-on:keyup="searchCustomer"
                        v-model="keyword"
                        class="form-control"
                        placeholder="customer"
                      />

                      <div class="input-group-append">
                        <a
                          @click.prevent="
                            modal([
                              { name: 'customerModal', show: false },
                              { name: 'newCustomerModal', show: true },
                            ])
                          "
                          href=""
                          class="btn btn-primary"
                          >Add new customer</a
                        >
                      </div>
                    </div>
                  </form>
                  <table class="table table-hover mt-3" width="100%">
                    <thead>
                      <tr>
                        <th width="30%">Name</th>
                        <th width="50%">Address</th>
                        <th width="20%">Phone</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        @click="updateCustomer(customer, false)"
                        v-for="(customer, index) in customers"
                        :key="index"
                      >
                        <td width="30%">
                          {{ customer.first_name }} {{ customer.last_name }}
                        </td>
                        <td width="50%">
                          {{ customer.address }}, {{ customer.area }},
                          {{ customer.city }}-{{ customer.post_code }},
                          {{ customer.country }}
                        </td>
                        <td width="20%">{{ customer.phone }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>

    <div v-if="newCustomerModal">
      <transition name="model">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add new customer</h4>
                  <div>
                    <a
                      href=""
                      @click.prevent="backToSearch"
                      class="btn btn-primary"
                      ><i class="fa fa-caret-left"></i
                    ></a>
                    <a
                      href=""
                      @click.prevent="resetForm('customer')"
                      class="btn btn-warning"
                      ><i class="fa fa-refresh"></i
                    ></a>
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="modal({ name: 'newCustomerModal', show: false })"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
                <div class="modal-body">
                  <form @submit.prevent="updateCustomer">
                    <div class="row ml-0 mr-0">
                      <div class="col-md-6 mb-3">
                        <label for="first-name">First Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="first-name"
                          placeholder="First Name"
                          required
                          v-model="customer.first_name"
                        />
                        <div class="invalid-feedback">
                          Please provide a valid city.
                        </div>
                        <div class="valid-feedback">Looks Good</div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="last-name">Last Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="last-name"
                          placeholder="Last Name"
                          required
                          v-model="customer.last_name"
                        />
                        <div class="invalid-feedback">
                          Please provide a valid city.
                        </div>
                        <div class="valid-feedback">Looks Good</div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input
                          type="text"
                          class="form-control"
                          id="email"
                          placeholder="Email"
                          v-model="customer.email"
                        />
                        <div class="invalid-feedback">
                          Please provide a valid city.
                        </div>
                        <div class="valid-feedback">Looks Good</div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="Phone">Phone</label>
                        <input
                          type="text"
                          class="form-control"
                          id="Phone"
                          placeholder="Phone"
                          required
                          v-model="customer.phone"
                        />
                        <div class="invalid-feedback">
                          Please provide a valid city.
                        </div>
                        <div class="valid-feedback">Looks Good</div>
                      </div>
                    </div>

                    <div class="form-group ml-15 mr-15">
                      <label for="address">Address</label>
                      <textarea
                        class="form-control"
                        placeholder="Address"
                        v-model="customer.address"
                      ></textarea>
                      <div class="invalid-feedback">
                        Please provide a valid city.
                      </div>
                      <div class="valid-feedback">Looks Good</div>
                    </div>

                    <div class="row ml-0 mr-0">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="area">Area</label>
                          <input
                            type="text"
                            id="area"
                            class="form-control"
                            name="area"
                            placeholder="Area"
                            v-model="customer.area"
                          />
                          <div class="invalid-feedback">
                            Please provide a valid city.
                          </div>
                          <div class="valid-feedback">Looks Good</div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="city">City/District/State</label>
                          <select
                            v-if="customer.country == 'BD'"
                            name="city"
                            class="form-control"
                            v-model="customer.city"
                          >
                            <option
                              v-for="(item, index) in districts"
                              :key="index"
                              :value="item"
                              :selected="item == 'Dhaka'"
                            >
                              {{ item }}
                            </option>
                          </select>

                          <input
                            v-else
                            type="text"
                            id="city"
                            class="form-control"
                            name="city"
                            placeholder="City"
                            v-model="customer.city"
                          />
                          <div class="invalid-feedback">
                            Please provide a valid city.
                          </div>
                          <div class="valid-feedback">Looks Good</div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="post_code">Post Code</label>
                          <input
                            type="text"
                            id="post_code"
                            class="form-control"
                            name="post_code"
                            placeholder="Post Code"
                            v-model="customer.post_code"
                          />
                          <div class="invalid-feedback">
                            Please provide a valid city.
                          </div>
                          <div class="valid-feedback">Looks Good</div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="country">Country</label>
                          <select
                            @change="changeCountry($event)"
                            name="country"
                            id="country"
                            class="form-control"
                            v-model="customer.country"
                          >
                            <option
                              v-for="(item, index) in countries"
                              :key="index"
                              :value="item.key"
                              :selected="item.key == 'BD'"
                            >
                              {{ item.value }}
                            </option>
                          </select>
                          <div class="invalid-feedback">
                            Please provide a valid country.
                          </div>
                          <div class="valid-feedback">Looks Good</div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group ml-15 mr-15">
                      <input
                        type="submit"
                        value="Save Changes"
                        class="btn btn-primary btn-block"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </section>
</template>


<script>
export default {
  props: [
    "customerModal",
    "customer",
    "newCustomerModal",
    "customers",
    "districts",
    "countries",
  ],

  data() {
    return {
      customerList: [],
      keyword: "",
    };
  },

  methods: {
    modal: function (model) {
      this.$emit("modal", model);
    },
    changeCountry(event) {
      let country = event.target.value;
      this.customer.city = country == "BD" ? "Dhaka" : "";
    },

    backToSearch: function () {
      this.$emit("objectUpdate", [
        { name: "newCustomerModal", value: false },
        { name: "customerModal", value: true },
      ]);
    },

    resetForm: function (form) {
      this.$emit("resetForm", form);
    },

    updateCustomer: function (customer = {}, isNewCustomer = true) {
      if (isNewCustomer) {
        this.modal({ name: "newCustomerModal", show: false });
        this.$emit("updateCustomer", this.customer);
      } else {
        this.modal([
          { name: "customerModal", show: false },
          { name: "newCustomerModal", show: true },
        ]);
        this.$emit("updateCustomer", customer);
      }
    },

    searchCustomer: function () {
      this.$emit("searchCustomer", this.keyword);
      console.log(this.keyword);
    },
  },
};
</script>

<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: top;
  min-height: 150px;
}
.modal-content {
  min-height: 250px;
}

.customer table tbody {
  display: block;
  max-height: calc(100vh - 275px);
  overflow-y: scroll;
}

.customer form{
    max-height: calc(100vh - 150px);
    overflow-y: scroll;
}

.customer table thead,
.customer table tbody tr {
  display: table;
  width: 100%;
  table-layout: fixed;
}

.customer table tbody tr {
  cursor: pointer;
}
</style>