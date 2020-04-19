<template>
    <div>
        <h1>Articles List</h1>

        <el-row align="center">
            <div class="col-md-4 col-sm-4 col-lg-4" >
                <el-input placeholder="Search" @change="search" @clear="getArticles" v-model="input"  clearable >
                    <el-button slot="append" icon="el-icon-search"></el-button>
                </el-input>
            </div>
        </el-row>

        <transition-group  class="list-complete" tag="section">
            <div v-for="item in articles" :key="item.id" class="list-complete-item">
                <div style="margin-top: 10px">
                    <h2>{{item.title}}</h2>
                    <p>{{item.body}}</p>
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
        name: 'articles',
        data() {
            return {
                articles: null,
                pagination : {},
                loading    : false,
                input      : '',
                keyword    : '',
            }
        },
        created() {
            this.getArticles()
        },
        methods: {
            getArticles(page = 1, keyword=this.keyword)
            {
                axios.get('/api/articles?page=' + page + '&keyword=' + keyword)
                    .then(res => {
                        //const{data:{data}} = res;
                        this.pagination =
                            {
                                "current_page": res.data.current_page,
                                "per_page": parseInt(res.data.per_page),
                                "total": res.data.total
                            }
                        this.articles=res.data.data;
                        this.loading = false;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            paginationCurrentChange(val) {
                this.loading = true;
                this.getArticles(val);
            },
            search(keyword)
            {
                if (keyword != '')
                {
                    clearTimeout(this.timeout);
                    this.timeout = setTimeout(() => {
                        this.loading = true;
                        this.keyword = keyword;
                        this.getArticles();
                    }, 500);
                }
                else
                {
                    this.keyword = '';
                    this.getArticles();
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
