<template>
  <div>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/' }">Inicio</el-breadcrumb-item>
      <el-breadcrumb-item>Usuarios</el-breadcrumb-item>
      <el-breadcrumb-item>Lista de usuarios</el-breadcrumb-item>
      <el-breadcrumb-item>Gestionar Usuario</el-breadcrumb-item>
    </el-breadcrumb>

    <b-row class="title">
      <h2>{{ userprop == null ? "Crear Usuario" : "Editar Usuario" }}</h2>

      <div class="title__info">
        <p>
          <i class="fas fa-info-circle"></i>Desde esta ventana podras crear o
          actualizar un usuario especifico
        </p>
      </div>
    </b-row>

    <b-row align-h="center">
      <b-col md="8" sm="12">
        <el-card shadow="hover">
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
            <label for="">Nombre Completo:</label>
            <el-input
              placeholder="Ingrese un nombre completo"
              v-model="user.name"
            ></el-input>
          </b-container>
          <br />
          <b-container>
            <label for="">Email:</label>
            <el-input
              placeholder="Ingrese un email"
              v-model="user.email"
            ></el-input>
          </b-container>
          <br />
          <br />
          <b-container v-if="userprop != null">
            <el-checkbox
              label="Desea cambiar la contraseña actual?"
              v-model="passwordEnable"
            ></el-checkbox>
          </b-container>
          <hr />
          <b-container>
            <b-row>
              <b-col md="6" sm="12">
                <label for="">Contraseña:</label>
                <el-input
                  :disabled="userprop != null ? !passwordEnable : false"
                  placeholder="Ingrese una contraseña"
                  v-model="user.password"
                  show-password
                ></el-input>
              </b-col>
              <b-col md="6" sm="12">
                <label for="">Confirmar Contraseña:</label>
                <el-input
                  :disabled="userprop != null ? !passwordEnable : false"
                  placeholder="Ingrese la confirmación de la contraseña"
                  v-model="confirmPassword"
                  show-password
                ></el-input>
              </b-col>
            </b-row>
          </b-container>
        </el-card>

        <b-container class="buttons-form">
          <b-row class="justify-content-center">
            <el-button
              type="success"
              size="large"
              @click="userprop != null ? edit() : create()"
              >{{ userprop == null ? "Crear" : "Editar" }}
              <i class="fas fa-save"></i
            ></el-button>
            <el-button type="danger" size="large" @click="goTo('/usuarios')"
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
  props: ["userprop"],
  data() {
    return {
      isError: false,
      msgError: "",
      user: {
        name: "",
        email: "",
        password: "",
      },
      confirmPassword: "",
      passwordEnable: false,
      value: "",
    };
  },
  created() {
    if (this.userprop != null) {
      this.user.name = this.userprop.name;
      this.user.email = this.userprop.email;
    } else {
      this.passwordEnable = true;
    }
  },
  methods: {
    goTo(location) {
      window.location.href = location;
    },
    validate() {
      let emailRule =
        /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

      if (!this.user.name) {
        this.isError = true;
        this.msgError = "Por favor ingrese un nombre";
        return false;
      } else if (!this.user.email) {
        this.isError = true;
        this.msgError = "Por favor ingrese un correo";
        return false;
      } else if (!emailRule.test(this.user.email)) {
        this.isError = true;
        this.msgError = "Por favor ingrese un correo valido";
        return false;
      } else {
        if (this.passwordEnable) {
          if (!this.user.password) {
            this.isError = true;
            this.msgError = "Por favor ingrese una contraseña";
            return false;
          }
          if (this.confirmPassword != this.user.password) {
            this.isError = true;
            this.msgError = "Las contraseñas no coinciden";
            return false;
          }
        }

        this.isError = false;
        this.msgError = "";
        return true;
      }
    },

    create() {
      if (this.validate()) {
        axios
          .post("/api/usuario", this.user)
          .then(() => {
            this.swal({
              title: "Usuario creado correctamente",
              icon: "success",
            }).then(() => {
              this.goTo("/usuarios");
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

    edit() {
      if (this.validate()) {
        let params = {};
        params.id = this.userprop.id;
        params.name = this.user.name;
        params.email = this.user.email;
        if (this.passwordEnable) {
          params.password = this.user.password;
        }
        axios
          .patch("/api/usuario", params)
          .then(() => {
            this.swal({
              title: "Usuario actualizado correctamente",
              icon: "success",
            }).then(() => {
              this.goTo("/usuarios");
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
</style>