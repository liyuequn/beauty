<template>
    <el-table
            v-loading="loading"
            :data="tableData"
            style="width: 100%">
        <el-table-column
                prop="created_at"
                label="日期"
                width="180">
        </el-table-column>
        <el-table-column
                prop="name"
                label="姓名"
                width="180">
        </el-table-column>
        <el-table-column
                prop="email"
                label="邮箱">
        </el-table-column>
        <el-table-column
                fixed="right"
                label="操作"
                width="120">
            <template slot-scope="scope">
                <el-button
                        type="text"
                        size="small">
                    查看
                </el-button>
            </template>
        </el-table-column>
    </el-table>
</template>

<script>
    export default {
        data() {
            return {
                loading:false,
                tableData: [{
                    updated_at: '',
                    created_at: '',
                    name: '',
                    email: ''
                },]
            }
        },
        methods:{

            getuser(){
                this.loading = true;
                var _this = this;
                axios.get('/api/users').then((res)=>{
                    _this.tableData = res.data.data;
                    this.loading = false;
                }).catch((error)=>{
                    if(error.response.status!=200){
                        _this.message('系统错误')
                    }
                })
            },



        },
        mounted(){
            this.getuser();
        }
    }
</script>