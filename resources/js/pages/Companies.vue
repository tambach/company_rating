<template>
    <div>
        <h1>Companies List</h1>
        <el-row >
            <div class="m-3 justify-center" style="">
                <el-select v-model="selected_category" @change="changeCategory" placeholder="აირჩიე კატეგორია" filterable clearable @clear="getCompanies">
                    <el-option
                        v-for="cat in categories"
                        :key="cat.id"
                        :label="cat.name"
                        :value="cat.id">
                    </el-option>
                </el-select>
                <div class="m-3" style="float: right;">
                    <el-input placeholder="მოძებნე კომპანია" @change="search" @clear="getCompanies" v-model="input"   clearable >
                        <el-button slot="append" icon="el-icon-search"></el-button>
                    </el-input>
                </div>
            </div>

        </el-row>

        <transition-group  class="list-complete" tag="section">
            <div v-for="item in companies" :key="item.id" class="list-complete-item">
                <div style="margin-top: 10px">
                    <h2><a :href="'/api/companies/'+item.id">{{item.id}}</a></h2>
                    <el-image  :src="`http://localhost:8090/storage/images/${item.image}`"
                               fit="contain" style="height:80%; width:80%"></el-image>
                    <p>{{item.address}}</p>
                    <p>{{item.cat_name}}</p>
                    <p>Phone: {{item.phone}}</p>
                </div>
            </div>
        </transition-group>

        <div class="text-center">
            <br>
            <el-pagination background layout="prev, pager, next"
                           :total="pagination.total"
                           :current-page.sync="pagination.current_page"
                           :page-size="pagination.per_page"
                           @current-change="paginationCurrentChange">
            </el-pagination>
            <br>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: 'companies',
        props: {
            msg: {
                type: String
            }
        },
        data() {
            return {
                companies  : null,
                categories : [],
                pagination : {},
                loading    : false,
                input      : '',
                keyword    : '',
                selected_category : '',
            }
        },
        created() {
            this.getCompanies();
            this.getCategories();
        },
        mounted: function ()
        {
            //this.getCompanies();
            //this.getCategories();
        },
        watch: {
            msg: function() {
                this.search(this.msg);
            }
        },
        methods: {
            changeCategory()
            {
                this.loading = true;
                this.getCompanies();
            },
            getCategories()
            {
                this.loading = true;
                axios.get('/categories')
                    .then(res => {
                        //const{data:{data}} = res;
                        this.categories=res.data;
                        this.loading = false;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            getCompanies(page = 1, keyword=this.keyword, category=this.selected_category)
            {
                axios.get('/companies?page=' + page + '&keyword=' + keyword + '&category=' +category )
                    .then(res => {
                        //const{data:{data}} = res;
                        this.pagination =
                            {
                                "current_page": res.data.current_page,
                                "per_page": parseInt(res.data.per_page),
                                "total": res.data.total
                            }
                        this.companies=res.data.data;
                        this.loading = false;
                        this.keyword   = keyword;
                        this.selected_category   = category;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            paginationCurrentChange(val) {
                this.loading = true;
                this.getCompanies(val);
            },
            search(keyword)
            {
                if (keyword != '')
                {
                    clearTimeout(this.timeout);
                    this.timeout = setTimeout(() => {
                        this.loading = true;
                        this.keyword = keyword;
                        this.getCompanies();
                    }, 500);
                }
                else
                {
                    this.keyword = '';
                    this.getCompanies();
                }
            },
        }

    }
</script>

<style>
    .list-complete {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    .list-complete-item {
        flex: 1 1 25%;
    }
</style>
