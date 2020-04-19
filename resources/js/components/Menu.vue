<template>
    <div id="navid">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="/" class="navbar-brand">
                <img src="../assets/logo.png" height="24" alt="CoolBrand">
                <b-navbar-brand href="/"> FYC</b-navbar-brand>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="/" class="nav-item nav-link">Companies</a>
                    <a href="/articles" class="nav-item nav-link">Articles</a>
                    <a href="/about" class="nav-item nav-link ">About</a>

                </div>
              <!--  <div class="navbar-nav ml-auto">
                    <el-input placeholder="მოძებნე კომპანია" @keyup.enter="submit" @change="submit" v-model="tempMessage"  >
                        <el-button slot="append" icon="el-icon-search"></el-button>
                    </el-input>
                </div> -->
            </div>
                <div class="navbar-nav">
                    <div  v-if="!$auth.check()" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                        <a :href="route.path" class="nav-item nav-link"> {{route.name}}</a>
                    </div>
                    <div v-if="$auth.check(1)" v-for="(route, key) in routes.user" v-bind:key="route.path">
                        <a :href="route.path" class="nav-item nav-link"> {{route.name}}</a>
                    </div>
                    <div v-if="$auth.check(2)" v-for="(route, key) in routes.admin" v-bind:key="route.path">
                        <a :href="route.path" class="nav-item nav-link"> {{route.name}}</a>
                    </div>
                    <div v-if="$auth.check()">
                        <a href="#" @click.prevent="$auth.logout()" class="nav-item nav-link">Logout</a>
                    </div>
                </div>

        </nav>

        <!-- <div id="nav">
           <router-link to="/">Home</router-link> |
           <router-link to="/about">About</router-link> |
           <router-link to="/articles">Articles</router-link> |
         </div> -->
    </div>

  <!--  <ul>
        <li v-if="!$auth.check()" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
            <router-link  :to="{ name : route.path }" :key="key">
                {{route.name}}
            </router-link>
        </li>
        <li v-if="$auth.check(1)" v-for="(route, key) in routes.user" v-bind:key="route.path">
            <router-link  :to="{ name : route.path }" :key="key">
                {{route.name}}
            </router-link>
        </li>
        <li v-if="$auth.check(2)" v-for="(route, key) in routes.admin" v-bind:key="route.path">
            <router-link  :to="{ name : route.path }" :key="key">
                {{route.name}}
            </router-link>
        </li>
        <li v-if="$auth.check()">
            <a href="#" @click.prevent="$auth.logout()">Logout</a>
        </li>
    </ul> -->
</template>

<script>
  export default {
    data() {
      return {
        tempMessage: '',
        routes: {
          // UNLOGGED
          unlogged: [
            {
              name: 'Signup',
              path: 'register'
            },
            {
              name: 'Login',
              path: 'login'
            },
          ],

          // LOGGED USER
          user: [
            {
              name: 'Dashboard',
              path: 'dashboard'
            }
          ],
          // LOGGED ADMIN
          admin: [
            {
              name: 'Dashboard',
              path: 'admin.dashboard'
            }
          ]
        }
      }
    },
      methods: {
          submit: function() {
              this.$emit("inputData", this.tempMessage);
              this.tempMessage = "";
          }
      },

    mounted() {
      //
    }
  }
</script>
