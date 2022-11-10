<template>
  <section class="inventory">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"
        ><b style="font-size: 22px">POS(Point Of Sale)</b></a
      >
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a href="/pos" target="_blank" class="nav-link btn btn-secondary">
              <i class="fa fa-plus"></i>
              New Order</a
            >
          </li>

          <li class="nav-item">
            <a
              @click.prevent="syncInventory()"
              class="nav-link btn btn-secondary"
              href="#"
            >
              <i class="fa fa-refresh"></i> Sync
              <span class="sr-only">(current)</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-secondary" href="/admin/users/logout"
              ><i class="fa fa-sign-out"></i> Logout</a
            >
          </li>
        </ul>
      </div>
    </nav>

    <div class="row mb-2">
      <div class="col-lg-4">
        <select
          @change="searchByCollection($event)"
          class="custom-select my-1 mr-sm-2"
          id="inlineFormCustomSelectPref"
        >
          <option value="0" selected>All Collection</option>
          <option
            :value="index"
            v-for="(item, index) in collections"
            :key="index"
          >
            {{ item }}
          </option>
        </select>
      </div>

      <div class="col-lg-4">
        <select
          class="custom-select my-1 mr-sm-2"
          id="inlineFormCustomSelectPref"
          @change="searchByProductType($event)"
        >
          <option selected="true" value="0">All Product Types</option>
          <option
            v-for="(item, index) in productTypes"
            :key="index"
            :value="item"
          >
            {{ item }}
          </option>
        </select>
      </div>

      <div class="col-lg-4">
        <form>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <i class="fa fa-search"></i>
              </span>
            </div>
            <input
              v-model="keyword"
              v-on:keyup="searchProduct"
              type="text"
              class="form-control"
              placeholder="Title, Tag, Type.."
            />
          </div>
        </form>
      </div>
    </div>

    <div class="row products">
      <div
        class="col-sm-6 col-lg-4 product"
        v-for="(item, index) in items"
        :key="index"
      >
        <div class="card" @click="addCartItem(item)">
          <div class="card-body">
            <div class="title">
              <h6>{{ item.title }}</h6>
            </div>
            <div class="bottom">
              <h6>
                &#2547;{{ item.price }} <br />

                <span v-if="item.q_available > 0" class="badge badge-success">
                  in stock
                </span>

                <span
                  v-else-if="item.sell_w_stock == true"
                  class="badge badge-primary"
                >
                  sell without stock
                </span>

                <span v-else class="badge badge-danger"> out of stock </span>
              </h6>
              <img class="img-fluid" :src="item.image" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="variantModal" class="variantModal">
      <transition name="model">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Choose your favourite variant</h4>
                  <div>
                    <button
                      type="button"
                      class="btn btn-danger"
                      @click="closeVariantModal()"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div
                      style="cursor: pointer"
                      class="col-lg-4 mt-2"
                      v-for="(item, index) in selected_product.product_variants"
                      :key="index"
                      @click="addCartItem(item)"
                    >
                      <div class="card">
                        <img
                          class="mx-auto mt-2"
                          :src="
                            api_root + 'image?src=' + item.image + '&size=64x64'
                          "
                          width="64px"
                          height="64px"
                          alt="Card image cap"
                        />
                        <div class="card-body text-center">
                          <h6
                            v-for="(option, op_index) in item.option_values"
                            :key="op_index + item.id"
                            class="card-title"
                          >
                            {{ op_index }} : {{ option }}
                          </h6>
                          <p class="card-text">{{ item.sku }}</p>

                          <h6>
                            &#2547;{{ item.price }} <br />

                            <span
                              class="badge badge-success"
                              v-if="item.q_available > 0"
                            >
                              in stock
                            </span>

                            <span
                              class="badge badge-primary"
                              v-else-if="item.sell_w_stock == true"
                            >
                              sell without stock
                            </span>

                            <span class="badge badge-danger" v-else>
                              out of stock
                            </span>
                          </h6>
                        </div>
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
  </section>
</template>

<script>
export default {
  props: ["items", "api_root", "order", "productTypes", "collections"],
  data() {
    return {
      keyword: "",
      variantModal: false,
      selected_product: {},
    };
  },

  methods: {
    addCartItem: function (item) {
      console.log("fron Inventory");
      console.log(item);
      if (item.hasOwnProperty("products_id") && item.id > 0) {
        if (item.q_available <= 0 && item.sell_w_stock == false) {
          return;
        }

        let v_item = {};
        v_item.id = item.products_id;
        v_item.variant_id = item.id;
        v_item.title = this.selected_product.title;
        v_item.price = item.price;
        v_item.sku = item.sku;
        v_item.options = JSON.stringify(item.option_values);
        v_item.q_available = item.q_available;
        v_item.sell_w_stock = item.sell_w_stock;
        v_item.image =
          this.api_root + "image?src=" + item.image + "&size=64x64";

        this.variantModal = false;
        this.$emit("newItemAdded", v_item);
      } else if (
        item.hasOwnProperty("product_variants") &&
        item.product_variants.length > 0
      ) {
        this.selected_product = item;
        this.variantModal = true;
      } else {
        this.$emit("newItemAdded", item);
      }
    },
    searchProduct: function () {
      this.$emit("searchProduct", this.keyword);
    },
    searchByProductType: function (event) {
      let type = event.target.value;
      this.$emit("searchByProductType", type);
    },

    searchByCollection: function (event) {
      let collection = event.target.value;
      this.$emit("searchByCollection", collection);
    },

    closeVariantModal: function () {
      this.variantModal = false;
    },

    syncInventory: function () {
      this.$emit("syncInventory");
    },
  },
};
</script>

<style>
.inventory .navbar {
  margin-top: 15px;
}
.inventory .bg-light {
  background-color: #fff !important;
}
.inventory .navbar-nav li {
  margin-left: 10px;
}
.inventory .product .bottom {
  /* border: 1px solid red; */
  height: 100px;
  display: flex;
  justify-content: space-between;
  align-items: baseline;
}
.inventory .product {
  margin-top: 5px;
  margin-bottom: 5px;
  cursor: pointer;
}
.inventory .product .bottom h4 {
  width: 40%;
  /* border: 1px solid red; */
}

.inventory .product .bottom img {
  width: 77px !important;
  height: 77px !important;
  border-radius: 10px;
  /* border: 1px solid red; */
}

.inventory .product .title {
  height: 40px;
}

.products {
  /* border: 1px solid red; */
  height: calc(100vh - 120px);
  overflow-y: scroll;
}
.card-horizontal {
  display: flex;
  flex: 1 1 auto;
}
</style>