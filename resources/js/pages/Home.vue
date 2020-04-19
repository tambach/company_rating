<template>
    <div id="app">
        <Companies :msg="childData" />
    </div>
</template>

<script>
    import Companies from "./Companies";

    export default {
        name: "App",
        components: {
            Companies
        },

        data: function() {
            return {
                childData: ""
            };
        },
        methods: {
            updateMessage(variable) {
                this.childData= variable;
            }
        }
    };
</script>
<style>
    #app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
    }

    #nav {
        padding: 30px;
    }

    #nav a {
        font-weight: bold;
        color: #2c3e50;
    }

    #nav a.router-link-exact-active {
        color: #42b983;
    }
</style>
