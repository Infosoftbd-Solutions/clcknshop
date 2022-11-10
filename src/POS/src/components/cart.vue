<template>
  <section class="cart">
    <div class="cart-heading d-flex justify-content-between">
      <h4
        style="
          margin-bottom: 0px !important;
          padding-top: 22px;
          font-size: 20px;
        "
      >
        Current order items
      </h4>
      <ul class="d-flex flex-row">
        <li>
          <a
            class="btn btn-primary"
            @click.prevent="modal({ name: 'customerModal', show: true })"
            href=""
            ><i class="fa fa-user-plus"></i
          ></a>
        </li>
        <li>
          <a class="btn btn-danger" @click.prevent="cartClear" href="">Clear</a>
        </li>
        <!-- <li>
          <div class="btn-group">
            <button
              type="button"
              class="btn btn-secondary"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="fa fa-cog"> </i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <button class="dropdown-item" type="button">Action</button>
              <button class="dropdown-item" type="button">
                Another action
              </button>
              <button class="dropdown-item" type="button">
                Something else here
              </button>
            </div>
          </div>
        </li> -->
      </ul>
    </div>
    <div class="card items">
      <div class="card-body">
        <form>
          <div
            class="item"
            v-for="(item, index) in order.cartItems"
            :key="index"
          >
            <div class="image">
              <img :src="item.image" />
              <span @click="removeCartItem(index)" class="badge badge-danger"
                ><i class="fa fa-times"></i
              ></span>
            </div>
            <div class="title">{{ item.title }}</div>
            <div class="input-group quantity">
              <div class="input-group-prepend">
                <span
                  class="input-group-text"
                  @click="cartItemDecrement(index)"
                  id="basic-addon1"
                  ><i class="fa fa-minus"></i
                ></span>
              </div>
              <input
                style="
                  padding: 0px !important;
                  margin: 0px !important;
                  text-align: center;
                "
                readonly
                type="text"
                class="form-control"
                placeholder="0"
                v-model="order.cartItems[index].quantity"
              />

              <div class="input-group-append">
                <span
                  class="input-group-text"
                  @click="cartItemIncrement(index)"
                  id="basic-addon1"
                  ><i class="fa fa-plus"></i
                ></span>
              </div>
            </div>
            <div class="price">
              &#2547; {{ (item.price * item.quantity).toFixed(2) }}
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-body">
        <div class="subtotal info">
          <h4>Subtotal</h4>
          <p class="amount">
            &#2547; <span>{{ cartSubtotal.toFixed(2) }}</span>
          </p>
        </div>
        <div class="discout info">
          <select
            class="custom-select"
            v-model="discout_type"
            id="inputGroupSelect01"
          >
            <option :selected="discout_type == 1" value="1">Discout(%)</option>
            <option :selected="discout_type == 2" value="2">
              Discout(Flat)
            </option>
          </select>
          <input
            type="text"
            v-model="discount_value"
            class="form-control"
            placeholder="0"
          />
          <div class="calculated-value">
            - &#2547; <span>{{ calculateDiscount.toFixed(2) }}</span>
          </div>
        </div>

        <div class="tax info">
          <select
            v-model="tax_type"
            class="custom-select"
            id="inputGroupSelect01"
          >
            <option :selected="tax_type == 1" value="1">Tax(%)</option>
            <option :selected="tax_type == 1" value="2">Tax(Flat)</option>
          </select>
          <input
            type="text"
            v-model="tax_value"
            class="form-control"
            placeholder="0"
          />
          <div class="calculated-value">
            &#2547; <span>{{ calculateTax.toFixed(2) }}</span>
          </div>
        </div>

        <div class="total info">
          <h4>Total</h4>
          <p class="amount">
            &#2547; <span>{{ cartTotal.toFixed(2) }}</span>
          </p>
        </div>

        <div class="row button">
          <div class="col-12">
            <a
              href=""
              @click.prevent="showPaymentModal()"
              class="btn btn-primary d-block"
              ><i class="fa fa-money"></i> Payment</a
            >
          </div>
        </div>
      </div>
    </div>

    <div v-if="paymentModal" class="paymentModal">
      <transition name="model">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Order Payment</h4>
                  <div>
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="modal({ name: 'paymentModal', show: false })"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <fieldset class="scheduler-border">
                        <legend class="scheduler-border">
                          Payment Methods
                        </legend>
                        <div
                          class="form-check"
                          v-for="(item, index) in paymentMethods"
                          :key="index"
                        >
                          <input
                            class="form-check-input"
                            type="radio"
                            :id="'payment_method_' + index"
                            :value="item.id"
                            :checked="index == 0"
                            v-model="order.payment_method"
                          />
                          <label
                            class="form-check-label"
                            :for="'payment_method_' + index"
                          >
                            {{ item.name }}
                          </label>
                        </div>
                      </fieldset>
                    </div>

                    <div class="col-md-6">
                      <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Transection</legend>
                        <form action="javascript:void(0)">
                          <!-- <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Total Amount</label>
                                <div class="col-sm-8">
                                <input type="text" readonly class="form-control">
                                </div>
                            </div> -->
                          <div class="form-group row">
                            <label
                              for="staticEmail"
                              class="col-sm-4 col-form-label"
                              >Order Total</label
                            >
                            <div class="col-sm-8">
                              <input
                                type="text"
                                readonly
                                class="form-control"
                                :value="order.total"
                              />
                            </div>
                          </div>
                          <div class="form-group row">
                            <label
                              for="staticEmail"
                              class="col-sm-4 col-form-label"
                              >Total Due</label
                            >
                            <div class="col-sm-8">
                              <input
                                type="text"
                                readonly
                                class="form-control"
                                :value="totalDue"
                              />
                            </div>
                          </div>
                          <div class="form-group row">
                            <label
                              for="staticEmail"
                              class="col-sm-4 col-form-label"
                              >Total Deposit</label
                            >
                            <div class="col-sm-8">
                              <input
                                @keypress="isNumber($event)"
                                type="text"
                                class="form-control"
                                v-model="order.total_paid"
                              />
                            </div>
                          </div>
                          <div class="form-group">
                            <input
                              @click="confirm_order()"
                              type="submit"
                              class="btn btn-primary btn-block"
                              value="Confirm Order"
                            />
                          </div>
                        </form>
                      </fieldset>
                    </div>

                    <div class="col-lg-8">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th width="5%">SL.NO</th>
                            <th width="60%">PRODUCT</th>
                            <th width="5%">QNT</th>
                            <th width="15%">UNIT</th>
                            <th width="15%">AMOUNT</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(item, index) in order.cartItems"
                            :key="index"
                          >
                            <td>{{ index + 1 }}</td>
                            <td>
                              {{ item.title }} <br />
                              {{
                                item.hasOwnProperty("options")
                                  ? item.options
                                  : ""
                              }}
                            </td>
                            <td>{{ item.quantity }}</td>
                            <td>{{ item.price.toFixed(2) }}</td>
                            <td>
                              {{ (item.price * item.quantity).toFixed(2) }}
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3" rowspan="7"></td>
                            <td>Subtotal</td>
                            <td>{{ order.subtotal.toFixed(2) }}</td>
                          </tr>

                          <tr>
                            <td>Discount</td>
                            <td>{{ parseFloat(order.discount).toFixed(2) }}</td>
                          </tr>

                          <tr>
                            <td>Tax</td>
                            <td>{{ order.tax.toFixed(2) }}</td>
                          </tr>

                          <!-- <tr>
                            <td>Shipping</td>
                            <td>{{ shipping.toFixed(2) }}</td>
                          </tr> -->

                          <tr>
                            <td>Total</td>
                            <td>{{ order.total.toFixed(2) }}</td>
                          </tr>

                          <tr>
                            <td>Total Paid</td>
                            <td>
                              {{
                                parseFloat(order.total_paid)
                                  ? parseFloat(order.total_paid).toFixed(2)
                                  : parseFloat(0).toFixed(2)
                              }}
                            </td>
                          </tr>

                          <tr>
                            <td>Total Due</td>
                            <td>
                              {{
                                parseFloat(
                                  order.total - order.total_paid
                                ).toFixed(2)
                              }}
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-lg-4">
                      <div class="card">
                        <div class="card-header">
                          Customer
                          <span
                            @click.prevent="
                              modal([
                                { name: 'paymentModal', show: false },
                                { name: 'newCustomerModal', show: true },
                              ])
                            "
                            style="cursor: pointer"
                            class="pull-right"
                            ><i
                              class="fa fa-pencil text-black"
                              style="font-size: 18px"
                            ></i
                          ></span>
                        </div>
                        <table class="table">
                          <tr>
                            <th>First Name</th>
                            <td>{{ order.customer.first_name }}</td>
                          </tr>
                          <tr>
                            <th>Last Name</th>
                            <td>{{ order.customer.last_name }}</td>
                          </tr>

                          <tr>
                            <th>Email</th>
                            <td>{{ order.customer.email }}</td>
                          </tr>

                          <tr>
                            <th>Phone</th>
                            <td>{{ order.customer.phone }}</td>
                          </tr>
                          <tr>
                            <th>Address</th>
                            <td>{{ order.customer.address }}</td>
                          </tr>
                          <tr>
                            <th>Area</th>
                            <td>{{ order.customer.area }}</td>
                          </tr>

                          <tr>
                            <th>City</th>
                            <td>{{ order.customer.city }}</td>
                          </tr>

                          <tr>
                            <th>Country</th>
                            <td>{{ order.customer.country }}</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>

    <div v-if="confirmOrderModal" class="confirmOrderModal">
      <transition name="model">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">
                    Order Placed #{{ confirmOrderResponse.order_id }}
                  </h4>
                  <div>
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="modal({ name: 'confirmOrderModal', show: false })"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered border-primary">
                    <tr>
                      <th>Customer</th>
                      <td>{{ confirmOrderResponse.customer }}</td>
                    </tr>
                    <tr>
                      <th>Phone</th>
                      <td>{{ confirmOrderResponse.phone }}</td>
                    </tr>

                    <tr>
                      <th>Order ID</th>
                      <td>{{ confirmOrderResponse.order_id }}</td>
                    </tr>

                    <tr>
                      <th>Order Total</th>
                      <td>{{ confirmOrderResponse.order_total }}</td>
                    </tr>

                    <tr>
                      <th>Total Paid</th>
                      <td>{{ confirmOrderResponse.total_paid }}</td>
                    </tr>
                    <tr>
                      <th>Total Due</th>
                      <td>{{ confirmOrderResponse.total_due }}</td>
                    </tr>

                    <tr>
                      <th>Order Date</th>
                      <td>{{ confirmOrderResponse.order_date }}</td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <a
                          @click="showInvoice(confirmOrderResponse.invoice_url)"
                          href="javascript:void(0)"
                          class="btn btn-primary"
                          >Print Invoice</a
                        >
                        <a
                          href="javascript:void(0)"
                          @click="
                            modal({ name: 'confirmOrderModal', show: false })
                          "
                          class="btn btn-danger pull-right"
                          >close</a
                        >
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>

    <div v-if="errorModal" class="errorModal">
      <transition name="model">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">
                    <i
                      class="fa fa-exclamation-triangle text-danger"
                      aria-hidden="true"
                    ></i>
                    Something went wrong!
                  </h5>
                  <div>
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="modal({ name: 'errorModal', show: false })"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered">
                    <tr
                      class="d-flex justify-content-start align-items-center"
                      v-for="(error, index) in errors"
                      :key="index"
                    >
                      <div class="p-3" style="font-size: 26px">
                        <i
                          class="fa fa-exclamation-triangle text-danger"
                          aria-hidden="true"
                        ></i>
                      </div>
                      <div class="py-2">
                        <span class="d-block">{{ error.title }}</span>
                        <b class="text-danger">{{ error.error }}</b>
                      </div>
                    </tr>
                  </table>
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
    "items",
    "order",
    "cartItems",
    "confirmOrderModal",
    "errorModal",
    "paymentModal",
    "customer",
    "paymentMethods",
    "confirmOrderResponse",
    "errors",
    // "discount_value",
    // "tax_value",
  ],

  data() {
    return {
      discounted_price: 0,
      discout_type: 1,
      discount_value: "",
      tax_type: 1,
      tax_value: "",
    };
  },

  computed: {
    // total: function () {
    //   this.order.total_paid = this.order.total;
    //   return this.order.total_paid;
    // },
    totalDue: function () {
      let due = this.order.total - this.order.total_paid;
      this.order.total_due = due;
      console.log(due);
      return due;
    },
    cartSubtotal: function () {
      var subtotal = 0;
      this.order.cartItems.forEach((item) => {
        if (
          item.quantity == 0 ||
          item.quantity.length == 0 ||
          item.quantity === null
        ) {
          item.quantity = 1;
        }
        subtotal += parseFloat(item.price) * item.quantity;
      });
      this.order.subtotal = subtotal;
      return subtotal;
    },

    calculateDiscount: function () {
      this.order.discount = parseFloat(this.discount_value)
        ? parseFloat(this.discount_value)
        : 0;
      if (this.discout_type == 1) {
        this.order.discount =
          parseFloat(this.order.subtotal) *
          parseFloat(this.order.discount / 100);
      }

      this.discounted_price =
        parseFloat(this.order.subtotal) - parseFloat(this.order.discount);
      return this.order.discount;
    },

    calculateTax: function () {
      this.order.tax = parseFloat(this.tax_value)
        ? parseFloat(this.tax_value)
        : 0;
      if (this.tax_type == 1) {
        this.order.tax =
          parseFloat(this.discounted_price) * parseFloat(this.order.tax / 100);
      }

      return this.order.tax;
    },

    cartTotal: function () {
      this.order.total =
        parseFloat(this.discounted_price) + parseFloat(this.order.tax);
      this.updateCart();
      return this.order.total ? this.order.total : 0;
    },
  },

  methods: {
    showInvoice: function (href) {
      this.modal({ name: "confirmOrderModal", show: false });
      setTimeout(function () {
        window.open(href, "_blank");
      }, 300);
    },
    confirm_order: function () {
      this.$emit("confirmOrder", this.order);
    },

    isNumber: function (evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      if (
        charCode > 31 &&
        (charCode < 48 || charCode > 57) &&
        charCode !== 46
      ) {
        evt.preventDefault();
      } else {
        return true;
      }
    },

    removeCartItem: function (index) {
      this.$emit("removeCartItem", index);
    },
    cartClear: function () {
      (this.discount_value = 0), (this.tax_value = 0), this.$emit("cartClear");
    },
    cartItemIncrement: function (index) {
      console.log("From Increment Event :");
      console.log(this.order.cartItems[index]);

      let item = this.order.cartItems[index];

      if (
        item.q_available >= this.order.cartItems[index].quantity + 1 ||
        item.sell_w_stock == true
      )
        this.order.cartItems[index].quantity += 1;
    },

    cartItemDecrement: function (index) {
      if (this.order.cartItems[index].quantity > 1) {
        this.order.cartItems[index].quantity -= 1;
      }
    },
    updateCart: function () {
      this.$emit("updateCart", this.order.cartItems);
    },

    modal: function (modal) {
      this.$emit("modal", modal);
    },

    item: function (product_id) {
      //console.log(product_id);
      let match_item = false;
      this.items.forEach(function (item, index) {
        if (item.id == product_id) match_item = item;
      });

      return match_item;
    },

    showPaymentModal: function () {
      if (this.order.cartItems.length == 0) return;

      let c = this.order.customer;
      if (
        c.first_name == "" ||
        c.last_name == "" ||
        // c.email == "" ||
        c.phone == "" ||
        // c.address == "" ||
        // c.area == "" ||
        // c.city == "" ||
        c.country == ""
        // c.post_code == ""
      ) {
        this.modal({ name: "customerModal", show: true });
        return;
      }
      this.order.total_paid = this.order.total;
      this.modal({ name: "paymentModal", show: true });
    },
  },
};
</script>

<style>
.cart {
  /* background-color: #FDFDFB; */
  padding: 15px 5px;
  height: 100vh;
  /* border-left: 2px solid #f2f2f2; */
}
.cart-heading h3 {
  padding-top: 9px !important;
}
.cart ul {
  display: inline-block;
  margin: 0;
  padding: 0;
}
.cart ul li {
  list-style: none;
  margin: 10px 5px;
}
.cart ui li .dropdown-toggle::after {
  display: none i !important;
}
.cart .items {
  height: calc(100vh - 375px);
  overflow-y: scroll;
}

.cart .items .card-body {
  margin: 0;
  padding: 15px 0px;
}

.cart .item {
  vertical-align: middle;
  padding-left: 0%;
  padding-right: 0%;
  margin-top: 5px;
  margin-bottom: 5px;
  /* vertical-align:top; */
  /* vertical-align:bottom; */
}

.cart .item img {
  height: 50px;
  width: 50px;
  border-radius: 8px;
  margin-right: 5px;
  vertical-align: middle;
}
.cart .item .image {
  position: relative;
  /* border: 1px solid #dfdfdf; */
}
.cart .item .image span {
  position: absolute;
  left: 0px;
  top: 0px;
  cursor: pointer;
}

.cart .item .quantity {
  width: 100px;
}

.cart .item .quantity .input-group-text {
  cursor: pointer;
  background-color: #f4f5f6 !important;
  border: 1px solid #f4f5f6;
}

.cart .item .quantity i {
  color: #858f9e;
  font-weight: normal;
  font-size: 12px;
}

.cart .item .quantity .form-control {
  border: 1px solid #f4f5f6 !important;
  background-color: #fdfdfb;
}
.cart .item .quantity .form-control:focus {
  box-shadow: none;
}
.cart .item .image {
  width: 48px;
}
.cart .item .price {
  font-size: 17px;
  font-weight: 500;
  width: 110px;
  text-align: left;
  padding-left: 5px;
}
.cart .item .title {
  width: 170px;
  padding-left: 6px;
}

.cart .item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  padding: 5px 10px;
}
.cart .info {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
}
.cart .info h4 {
  font-size: 18px;
}
.cart .discout select,
.cart .tax select {
  width: 135px;
}

.cart .discout .form-control,
.cart .tax .form-control {
  width: 70px;
}

.cart .amount,
.cart .calculated-value {
  font-size: 17px;
  font-weight: 500;
  width: 110px;
  padding-left: 5px;
  text-align: left;
}

.cart .total {
  border-top: 1px solid #ebeff3;
  padding-top: 5px;
}

.paymentModal .modal-body {
  /* max-height: calc(100vh - 275px);
        overflow-y: scroll; */
  height: 80vh;
  overflow-y: auto;
}

.paymentModal table th {
  font-weight: 450;
}

fieldset.scheduler-border {
  border: 1px groove #ddd !important;
  padding: 0 1.4em 1.4em 1.4em !important;
  margin: 0 0 1.5em 0 !important;
  -webkit-box-shadow: 0px 0px 0px 0px #000;
  box-shadow: 0px 0px 0px 0px #000;
}

legend.scheduler-border {
  font-size: 1.2em !important;
  font-weight: bold !important;
  text-align: left !important;
  width: auto;
  padding: 0 10px;
  border-bottom: none;
}
</style>