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
                <el-col :span="5">
                    <el-input v-model="filter.name" placeholder="类型" @keyup.enter.native="getList()" ></el-input>
                </el-col>
                <el-col :span="6">
                    <el-button type="primary" plain @click="getList()">搜索</el-button>
                    <el-button type="primary" plain @click="DialogVisible = true ;dialogTitle = '新增类型'">添加类型</el-button>
                </el-col>
                <el-col :span="6">
                </el-col>
            </el-row>
        </div>
        <el-table
                v-loading="loading"
                :data="tableData"
                style="width: 100%">
            <el-table-column
                    prop="created_at"
                    label="创建日期"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="类型"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="title"
                    label="标签">
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="操作"
                    width="220">
                <template slot-scope="scope">
                    <el-button
                            type="primary"
                            size="small"
                            @click="editTypeShow(scope.row)"
                            plain
                    >
                        编辑
                    </el-button>
                    <el-button
                            type="danger"
                            size="small"
                            @click="delete1(scope.row.id)"
                            plain
                    >
                        删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-dialog
                :title="dialogTitle"
                :visible.sync="DialogVisible"
                width="30%"
                center>

            <el-form :model="typeForm" ref="typeForm" :rules="rules">
                <el-form-item  prop="name">
                    <el-input v-model="typeForm.name" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>

            <span slot="footer" class="dialog-footer">
                <el-button @click="DialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="addType('typeForm')">确 定</el-button>
            </span>
        </el-dialog>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                DialogVisible:false,
                dialogTitle:'新增类型',
                loading:false,
                filter:{
                  name:'',
                },
                options:[
                    {value:'',label:'全部'},
                    {value:1,label:'技术'},
                    {value:2,label:'生活'},
                ],
                tableData: [],
                //addType
                typeForm:{
                    name:'',
                    author_id:0,
                },
                rules: {
                    name: [
                        { required: true, message: '不能为空', trigger: 'blur' },
                    ],
                },
            }
        },
        methods:{
            addType(formName){
                this.$refs[formName].validate((valid) => {
                    if(valid){
                        this.DialogVisible = false;
                        axios.post('/api/types',this.typeForm).then((res)=>{
                            this.$message.success('创建成功');
                            this.getList();
                        }).catch((error)=>{
                            this.$message.error('创建失败,目标或已存在');
                        })
                    }
                })
            },
            editTypeShow(row){
                this.DialogVisible = true;
                this.dialogTitle = '修改类型';
                this.typeForm.name = row.name;
                this.typeForm.id = row.id;
            },
            getList(){
                this.loading = true;
                let params = {
                    name:this.filter.name,
                }
                axios.get('/api/types',{params}).then((res)=>{
                    this.tableData = res.data[0];
                    this.loading = false;
                })
            },
            delete1(id){
                this.$confirm('删除, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then((res)=>{
                    axios.delete('/api/types/'+id).then((res)=>{
                        this.$message({
                            type: 'success',
                            message: '成功!'
                        });
                        this.getList();
                    })

                })
            },
        },
        mounted(){
            this.getList();
            const userInfo = JSON.parse(sessionStorage.getItem('userInfo'));
            this.typeForm.author_id = userInfo.id;
        }
    }
</script>