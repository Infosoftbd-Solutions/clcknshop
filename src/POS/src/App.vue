<template>
  <div id="app">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-xl-7">
          <inventory
            @searchProduct="searchProduct"
            @newItemAdded="addCartItem"
            @searchByProductType="searchByProductType"
            @searchByCollection="searchByCollection"
            @syncInventory="syncInventory"
            :api_root="api_root"
            :items="items"
            :order="order"
            :productTypes="productTypes"
            :collections="collections"
          ></inventory>
        </div>
        <div class="col-lg-6 col-xl-5">
          <cart
            @modal="modal"
            @updateCart="updateCart"
            @cartClear="cartClear"
            @removeCartItem="removeCartItem"
            @confirmOrder="confirmOrder"
            :errorModal="errorModal"
            :errors="errors"
            :items="items"
            :cartItems="cartItems"
            :paymentModal="paymentModal"
            :confirmOrderModal="confirmOrderModal"
            :customer="order.customer"
            :order="order"
            :paymentMethods="paymentMethods"
            :confirmOrderResponse="confirmOrderResponse"
          ></cart>
        </div>
      </div>
    </div>

    <add-customer
      @searchCustomer="searchCustomer"
      @resetForm="resetForm"
      @objectUpdate="objectUpdate"
      @updateCustomer="updateCustomer"
      @modal="modal"
      :customer="order.customer"
      :customerModal="customerModal"
      :newCustomerModal="newCustomerModal"
      :customers="customers"
      :countries="countries"
      :districts="districts"
    ></add-customer>

    <!-- <FlashMessage :position="'right bottom'"></FlashMessage> -->
  </div>
</template>

<script>
import Cart from "./components/cart.vue";
import Inventory from "./components/inventory.vue";
import AddCustomer from "./components/addCustoer.vue";
import axios from "axios";
//axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
//axios.defaults.headers.common["Accept"] = "application/json";
import Vue from "vue";
// import FlashMessage from "@smartweb/vue-flash-message";
// Vue.use(FlashMessage);
import countryList from "./data/country_list.js";
import bd_districts from "./data/bd_district.js";

export default {
  watch: {
    $route: {
      immediate: true,
      handler(to, from) {
        document.title = "POS (Point of Sale)";
      },
    },
  },
  components: {
    Cart,
    Inventory,
    AddCustomer,
  },

  data() {
    // var api_root = "http://localhost.clcknshop:8080/";
    var api_root = "/";
    return {
      api_root: api_root,
      api_url: api_root + "api/pos/",
      login_url: api_root + "admin/users/login",
      items: [],
      customers: [],
      products: [],
      productTypes: [],
      collections: [],
      customerList: [],
      countries: [],
      districts: [],
      paymentMethods: [],
      cartItems: [], // {id:1, variant_id: 0,  title: 'A4Tech HS-30 Headphone', price:150.00,  quantity:1, image:'https://genesis-zone.com/media/cache/genesis_menu_product/Z30312_137942.png' }
      paymentModal: false,
      confirmOrderModal: false,
      customerModal: false,
      newCustomerModal: false,
      isCustomerAdded: false,
      errorModal: false,
      errors: [],
      order: {
        customer: {
          first_name: "", //"Atik",
          last_name: "", //"Hassan",
          email: "", //"atik@infosoftbd.com",
          phone: "", // "01518307641",
          address: "", //"40/4/c East Hazipara, Rampura, Dhaka-1219",
          area: "", //"Rampura",
          city: "Dhaka", //"Dhaka",
          post_code: "", //1219,
          country: "BD", //"Bangladesh"
        },
        cartItems: [],
        subtotal: 0,
        discount: 0,
        total_paid: 0,
        total_due: 0,
        tax: 0,
        total: 0,
        payment_method: 1,
      },
      // discount_value: 0,
      // tax_value: 0,
      confirmOrderResponse: {},
    };
  },

  mounted() {
    // console.log(this.api_root);
    // console.log(countryList);
    this.countries = countryList;
    this.districts = bd_districts;
    this.fetchProducts("all");
    this.fetchProductTypes();
    this.fetchCollections();
    this.fetchCustomer();
    this.fetchPaymentMethods();
    // this.items = products;
    // this.customers = customers;

    //console.log(this.items);
    //console.log(this.customers);
  },

  methods: {
    syncInventory: function () {
      this.fetchProducts("all");
      this.fetchProductTypes();
      this.fetchCollections();
      this.fetchCustomer();
      this.fetchPaymentMethods();
    },

    fetchProducts: function (collection) {
      let api_root = this.api_root;
      axios
        .get(this.api_url + "collection/" + collection + ".json")
        .then((response) => {
          if (response.data.status == "unauthorized") {
            window.location.href = this.login_url;
          }
          //console.log(response.data);
          response.data.forEach(function (item, index) {
            if (item.title.length > 30) {
              item.title = item.title.substring(0, 30) + "...";
            } else {
              item.title = item.title.substring(0, 30);
            }

            item.image = api_root + "image?src=" + item.image + "&size=64x64";
          });

          //console.log(response.data);
          this.products = response.data;
          this.items = response.data;
        });
    },

    fetchProductTypes: function () {
      axios.get(this.api_url + "product-types").then((response) => {
        this.productTypes = response.data;
        // console.log(response.data);
      });
    },
    fetchCollections: function () {
      axios.get(this.api_url + "collections").then((response) => {
        this.collections = response.data;
      });
    },
    fetchCustomer: function (item) {
      axios.get(this.api_url + "customer-list.json").then((response) => {
        this.customers = response.data;
        this.customerList = response.data;
        // console.log(this.customerList);
      });
    },

    fetchPaymentMethods: function () {
      axios.get(this.api_url + "payment-methods").then((response) => {
        this.paymentMethods = response.data;
      });
    },

    confirmOrder: function (order) {
      let validCustomer = true;
      this.order = order;

      /*
      for (let key in order.customer) {
        let value = order.customer[key].trim();

        if (value.length == 0 || value === undefined || value === "") {
        }
      }
      */

      axios.post(this.api_url + "order-create", this.order).then((response) => {
        let res = response.data;

        if (res.status == "success") {
          /*this.order.cartItems = [];
          this.resetForm("customer");
          this.isCustomerAdded = false;
          this.discount_value = 0;
          this.tax_value = 0;
          this.order.total_paid = 0;
          this.order.total_due = 0;
          */
          this.cartClear();
          this.modal({ name: "paymentModal", show: false });
          this.modal({ name: "confirmOrderModal", show: true });
          this.confirmOrderResponse = res.data;
        }

        if (res.status == "fail") {
          this.errorModal = true;
          this.errors = res.data;
        }

        this.syncInventory();
      });

      //console.log(order);
    },
    addCartItem: function (item) {
      console.log("Log from App");
      console.log(item.q_available);
      var itemNotExists = true;
      item.variant_id = item.hasOwnProperty("variant_id") ? item.variant_id : 0;

      if (item.q_available <= 0 && item.sell_w_stock == false) return;

      this.order.cartItems.forEach((oldItem) => {
        if (oldItem.id == item.id && oldItem.variant_id == item.variant_id) {
          if (
            item.q_available >= parseInt(oldItem.quantity) + 1 ||
            item.sell_w_stock == true
          )
            oldItem.quantity = parseInt(oldItem.quantity) + 1;
          itemNotExists = false;
          return;
        }
      });

      if (itemNotExists) {
        let variant_id =
          item.variant_id === undefined || item.variant_id == ""
            ? 0
            : item.variant_id;
        let options = item.options === undefined ? "" : item.options;
        let sku = item.sku === undefined ? "" : item.sku;

        var newItem = {
          id: item.id,
          variant_id: variant_id,
          title: item.title,
          sku: sku,
          options: options,
          price: item.price,
          quantity: item.quantity ? item.quantity : 1,
          q_available: item.q_available,
          image: item.image,
        };
        this.order.cartItems.push(newItem);
      }
    },

    removeCartItem: function (index) {
      console.log(index);
      this.order.cartItems.splice(index, 1);
      // console.log(this.cartItems);
    },

    cartClear: function () {
      this.order.cartItems = [];
      this.resetForm("customer");
      this.order.total_paid = 0;
      this.order.total_due = 0;
      this.order.total = 0;
      this.order.subtotal = 0;
      this.order.discount = 0;
      this.order.tax = 0;
      this.order.payment_method = 1;
      this.isCustomerAdded = false;
    },
    updateCart: function (items) {
      this.order.cartItems = items;
    },
    modal: function (objModal) {
      console.log(objModal);

      if (Array.isArray(objModal)) {
        objModal.forEach((item) => {
          if (
            item.name == "customerModal" &&
            this.isCustomerAdded == true &&
            item.show == true
          ) {
            this.customerModal = false;
            this.newCustomerModal = true;
          } else {
            this.$data[item.name] = item.show;
          }
        });
      } else {
        //console.log(objModal.name);
        //console.log(this.isCustomerAdded);

        if (
          objModal.name == "customerModal" &&
          this.isCustomerAdded == true &&
          objModal.show == true
        ) {
          this.customerModal = false;
          this.newCustomerModal = true;
        } else {
          this.$data[objModal.name] = objModal.show;
        }
      }

      console.log(this.customerModal);
      console.log(this.newCustomerModal);

      /*  if(Object.keys(this.order.customer).length !== 0){
          this.newCustomerModal = true;
        }else{
          this.customerModal = status;
        }*/
    },
    updateCustomer: function (customer, set = true) {
      if (set) {
        this.order.customer = customer;
        this.isCustomerAdded = true;
        if (this.order.cartItems.length > 0 && this.newCustomerModal == false) {
          this.paymentModal = true;
        }
      } else {
        /*this.order.customer = {
          first_name: "", //"Atik",
          last_name: "", //"Hassan",
          email: "", //"atik@infosoftbd.com",
          phone: "", // "01518307641",
          address: "", //"40/4/c East Hazipara, Rampura, Dhaka-1219",
          area: "", //"Rampura",
          city: "", //"Dhaka",
          post_code: "", //1219,
          country: "", //"Bangladesh"
        };*/

        this.resetForm("customer");
        this.isCustomerAdded = false;
      }
    },

    objectUpdate: function (object) {
      if (Array.isArray(object)) {
        object.forEach((item) => {
          this.$data[item.name] = item.value;
        });
      } else {
        this.$data[object.name] = object.value;
      }
      console.log(object);
      console.log(this.customerModal);
      console.log(this.newCustomerModal);
    },

    resetForm: function (form) {
      switch (form) {
        case "customer":
          this.order.customer = {
            first_name: "", //"Atik",
            last_name: "", //"Hassan",
            email: "", //"atik@infosoftbd.com",
            phone: "", // "01518307641",
            address: "", //"40/4/c East Hazipara, Rampura, Dhaka-1219",
            area: "", //"Rampura",
            city: "Dhaka", //"Dhaka",
            post_code: "", //1219,
            country: "BD", //"Bangladesh"
          };
          break;
      }
    },

    searchProduct: function (keyword) {
      this.items = this.products.filter((item) => {
        return (
          item.title.toLowerCase().indexOf(keyword.toLowerCase()) !== -1 ||
          item.tags.toLowerCase().indexOf(keyword.toLowerCase()) !== -1
        );
      });
    },

    searchByProductType: function (type) {
      if (type == 0) {
        this.items = this.products;
        return;
      }

      this.items = this.products.filter((item) => {
        return (
          item.product_type.toLowerCase().indexOf(type.toLowerCase()) !== -1
        );
      });
    },
    searchCustomer: function (keyword) {
      this.customers = this.customerList.filter((item) => {
        return (
          item.first_name.toLowerCase().indexOf(keyword.toLowerCase()) !== -1 ||
          item.last_name.toLowerCase().indexOf(keyword.toLowerCase()) !== -1 ||
          item.phone.toLowerCase().indexOf(keyword.toLowerCase()) !== -1
        );
      });
    },

    searchByCollection: function (collection) {
      if (collection == 0) collection = "all";
      this.fetchProducts(collection);
      console.log(collection);
    },
  },
};
</script>



<style>


</style>
