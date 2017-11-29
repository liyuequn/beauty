<style>
    .search-bar{
        width:100%;height:64px;background-color:#F4F9FF;display:block;
        padding-top: 20px;padding-left:20px;
        margin-bottom:20px;
    }
</style>
<template>
    <section>
        <div class="search-bar">
            <el-row :gutter="20">
                <el-col :span="4">
                    <el-select v-model="type" placeholder="文章分类">
                        <el-option
                                v-for="item in options"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-col>
                <el-col :span="5">
                    <el-input v-model="title" placeholder="标题"></el-input>
                </el-col>
                <el-col :span="6">
                    <el-button type="primary" plain>搜索</el-button>
                    <el-button type="primary" plain @click="$router.push('/articles/write')">写文章</el-button>
                </el-col>
                <el-col :span="6">
                </el-col>
            </el-row>
        </div>
        <el-table
                :data="tableData"
                style="width: 100%">
            <el-table-column
                    prop="date"
                    label="日期"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="姓名"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="address"
                    label="地址">
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
                    <el-button
                            type="text"
                            size="small"
                            @click="$router.push('/articles/'+1)"
                    >
                        编辑
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <router-view></router-view>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                title:'',
                type:'',
                options:[
                    {value:1,label:'技术'},
                    {value:2,label:'生活'},
                ],
                tableData: [
                    {
                    date: '2016-05-02',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-04',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1517 弄'
                }, {
                    date: '2016-05-01',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1519 弄'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1516 弄'
                }]
            }
        },
        methods:{

        },
        mounted(){

        }
    }
</script>