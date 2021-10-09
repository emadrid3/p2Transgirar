<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Vehiculos</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de Vehiculos</el-breadcrumb-item>
      <el-breadcrumb-item>Gestionar Vehiculos</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>Gestionar Vehiculo</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras crear o
          actualizar un vehiculo especifico
        </p>
      </div>
    </b-row>

    <b-row align-h="center">
      <b-col md="8" sm="12">
        <el-card shadow="hover">
          <b-container>
            <b-row class="justify-content-center">
              <b-col
                md="4"
                sm="12"
                class="view-plate"
                :style="vehicle.plate ? '' : 'height:80px;'"
              >
                <div class="plate-content">
                  <h1>
                    <b>{{ vehicle.plate.toUpperCase() }}</b>
                  </h1>
                  <h5>{{ vehicle.city }}</h5>
                </div>
              </b-col>
            </b-row>
          </b-container>
          <el-alert
            v-if="isError"
            title="Error de validación"
            type="error"
            :description="msgError"
            show-icon
          >
          </el-alert>
          <br />
          <b-container>
            <b-row>
              <b-col md="6" sm="12">
                <label for="">Placa:</label>
                <el-input
                  placeholder="Ingrese un nombre"
                  v-model="vehicle.plate"
                ></el-input>
              </b-col>
              <b-col md="6" sm="12">
                <label for="">Ciudad:</label>
                <el-input
                  placeholder="Ingrese una ciudad"
                  v-model="vehicle.city"
                ></el-input>
              </b-col>
            </b-row>
          </b-container>
          <br />
          <b-container>
            <b-row>
              <b-col md="12" sm="12">
                <label for="">Tipo:</label>
                <el-select
                  v-model="vehicle.type"
                  placeholder="Seleccione un tipo de vehiculo"
                >
                  <el-option
                    v-for="item in optionsTipo"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value"
                  >
                  </el-option>
                </el-select>
              </b-col>
            </b-row>
          </b-container>
          <br />
          <b-container>
            <b-row>
              <b-col md="12" sm="12">
                <label for="">Conductor:</label>
                <el-select
                  v-model="vehicle.driver"
                  filterable
                  remote
                  reserve-keyword
                  placeholder="Ingrese la cedula o el nombre de un conductor"
                  :remote-method="remoteMethodDriver"
                  :loading="loading"
                >
                  <el-option
                    v-for="item in driverList"
                    :key="item.id"
                    :label="item.nombre"
                    :value="item.id"
                  >
                  </el-option>
                </el-select>
              </b-col>
            </b-row>
          </b-container>
          <br />
          <b-container>
            <label>Estado:</label>
            <b-form-checkbox size="lg" v-model="vehicle.estado" switch
              ><span>
                {{ vehicle.estado == true ? "Inactivar" : "Activar" }}
              </span></b-form-checkbox
            >
          </b-container>
        </el-card>

        <b-container class="buttons-form">
          <b-row class="justify-content-center">
            <el-button
              type="success"
              size="large"
              @click="vehicleprop != null ? edit() : create()"
              >{{ vehicleprop == null ? "Crear" : "Editar" }}
              <i class="fas fa-save"></i
            ></el-button>
            <el-button type="danger" size="large" @click="goTo('/vehiculos')"
              >Cancelar <i class="far fa-window-close"></i
            ></el-button>
          </b-row>
        </b-container>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  name: "UserManage",
  props: ["vehicleprop"],
  data() {
    return {
      optionsTipo: [
        {
          value: "propio",
          label: "PROPIO",
        },
        {
          value: "tercero",
          label: "TERCERO",
        },
      ],
      loading: false,
      isError: false,
      msgError: "",
      vehicle: {
        plate: "",
        city: "",
        type: null,
        driver: null,
        estado: false
      },
      driverList: [],
    };
  },
  created() {
    if (this.vehicleprop != null) {
      if(this.vehicleprop.driver != null){
      this.remoteMethodDriver(this.vehicleprop.driver.nombre);
      }
      this.vehicle.plate = this.vehicleprop.placa;
      this.vehicle.city = this.vehicleprop.ciudad;
      this.vehicle.type = this.vehicleprop.tipo;
      this.vehicle.driver = this.vehicleprop.conductor;
      this.vehicle.estado = this.vehicleprop.estado == 1 ? true : false;
    }
  },
  methods: {
    goTo(location) {
      window.location.href = location;
    },

    remoteMethodDriver(query) {
      if (query !== "") {
        this.loading = true;
        axios
          .get("/api/conductores-search", {
            params: { size: 10, input: query },
          })
          .then((response) => {
            this.driverList = response.data.data;
          })
          .catch(() => {
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      } else {
        this.driverList = [];
      }

      this.loading = false;
    },

    validate() {
      if (!this.vehicle.plate) {
        this.isError = true;
        this.msgError = "Por favor ingrese una placa";
        return false;
      } else if (!this.vehicle.type) {
        this.isError = true;
        this.msgError = "Por favor ingrese un tipo de vehiculo";
        return false;
      } else {
        this.isError = false;
        this.msgError = "";
        return true;
      }
    },

    create() {
      if (this.validate()) {
        axios
          .post("/api/vehiculos", this.vehicle)
          .then(() => {
            this.swal({
              title: "Vehiculo creado correctamente",
              icon: "success",
            }).then(() => {
              this.goTo("/vehiculos");
            });
          })
          .catch(() => {
            this.swal({
              title: "Algo salio mal",
              text: "Por favor intentelo nuevamente",
              icon: "error",
              button: "OK",
            });
          });
      }
    },
    async edit() {
      let params = {};
      params.id = this.vehicleprop.id;
      params.placa = this.vehicle.plate;
      params.ciudad = this.vehicle.city;
      params.tipo = this.vehicle.type;
      params.conductor = this.vehicle.driver;
      params.estado = this.vehicle.estado;
      await axios
        .patch("/api/vehiculos", params)
        .then(() => {
          this.swal({
            title: "Conductor actualizado correctamente",
            icon: "success",
          }).then(() => {
            this.goTo("/vehiculos");
          });
        })
        .catch(() => {
          this.swal({
            title: "Algo salio mal",
            text: "Por favor intentelo nuevamente",
            icon: "error",
            button: "OK",
          });
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.title {
  margin-top: 20px;
  margin-left: 0px;
  display: flex;
  flex-direction: column;
}

.buttons-form {
  margin-top: 20px;
}

.view-plate {
  background-color: #ffeb00;
  border-radius: 10px;
  border: 4px solid black;
}

.plate-content {
  display: flex;
  flex-direction: column;
  align-items: center;

  h1 {
    font-size: 50px;
  }
}

.el-select {
  position: relative;
  font-size: 14px;
  display: inline-block;
  width: 100%;
}

</style>