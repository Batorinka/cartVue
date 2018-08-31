const app = new Vue({
  el: '#app',
  data: {
    products: [],
    status: false,
    statusField: false,
    product: {
      title: null,
      price: null,
      quantity: null
    }
  },

  methods: {
    addProduct() {
      if (this.product.title !== null && this.product.price !== null) {
        var newProduct = {
          title: this.product.title,
          price: this.product.price,
          quantity: 1
        };

        this.products.push(newProduct);

        this.product.title = null;
        this.product.price = null;
        this.statusField = false;

        reqwest({
          url: '/addProduct.php',
          method: 'post',
          data: {
            product: newProduct
          },
          success: function(resp) {

          }
        })
      } else {
        this.statusField = true;
      }

      //запрос в базу на добавление продукта

    },

    makeOrder() {
      this.status = true;

      reqwest({
        url: '/makeOrder.php',
        method: 'post',
        data: {
          products: this.products
        },
        success: function(resp) {

        }
      })
      //Запрос в базу на оформление заказа (ДЗ)
    },

    deleteProduct(product) {
      this.products.splice(this.products.indexOf(product), 1);

      //Запрос в базу на удаление продукта по id
      reqwest({
        url: '/deleteProduct.php',
        method: 'post',
        data: {
          product_id: product.id
        },
        success: function(resp) {

        }
      })
    }
  },

  mounted() {
    const vm = this;
    reqwest('/products.php', function(resp) {
      vm.products = JSON.parse(resp);
    });
    // загружать товары из сервера, БД, сервиса
  },

  computed: {
    totalQuantity() {
      return this.products.reduce((sum, product) => {
        return sum + parseInt(product.quantity);
      }, 0);
    },

    totalPrice() {
      return this.products.reduce((sum, product) => {
        return sum + product.price * product.quantity;
      }, 0);
    }
  }

});