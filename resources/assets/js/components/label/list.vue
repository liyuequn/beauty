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
                    <el-select style="width:100%;" v-model="filter.type_id" placeholder="文章类型">
                        <el-option
                                v-for="item in options"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-col>
                <el-col :span="5">
                    <el-input v-model="filter.name" placeholder="标签" @keyup.enter.native="getList()" ></el-input>
                </el-col>
                <el-col :span="6">
                    <el-button type="primary" plain @click="getList()">搜索</el-button>
                    <el-button type="primary" plain @click="openDialog('labelForm')">添加标签</el-button>
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
                    label="标签"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="type_id"
                    label="类型"
                    :formatter="typeName"
            >
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="操作"
                    width="220">
                <template slot-scope="scope">
                    <el-button
                            type="primary"
                            size="small"
                            @click="editDialog(scope.row)"
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
        <div class="block" style="text-align: center;">
            <el-pagination
                    background="#F4F9FF"
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="currentPage"
                    :page-sizes="[10, 20, 50, 100]"
                    :page-size="pageSize"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="total">
            </el-pagination>
        </div>
        <el-dialog
                :title="dialogTitle"
                :visible.sync="DialogVisible"
                width="30%"
                center>

            <el-form :model="labelForm" status-icon ref="labelForm" :rules="rules">
                <el-form-item  prop="type_id" required>
                    <el-select style="width:100%;" v-model="labelForm.type_id" clearable placeholder="请选择文章类型">
                        <el-option
                                v-for="item in options"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item  prop="name" required  placeholder="请填写标签名称">
                    <el-input v-model="labelForm.name" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>

            <span slot="footer" class="dialog-footer">
                <el-button @click="DialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="addType('labelForm')">确 定</el-button>
            </span>
        </el-dialog>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                DialogVisible:false,
                dialogTitle:'新增标签',
                loading:false,
                filter:{
                    type:null,
                    name:null,
                },
                options:[],
                tableData: [],
                //page
                total:0,
                currentPage:1,
                pageSize:10,
                //addType
                labelForm:{
                    type_id:null,
                    name:null,
                    author_id:0,
                },
                rules: {
                    name: [
                        { required: true, message: '不能为空', trigger: 'blur' },
                    ],
                    type_id:[
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
                        axios.post('/api/labels',this.labelForm).then((res)=>{
                            this.$message.success('创建成功');
                            this.getList();
                        }).catch((error)=>{
                            this.$message.error('创建失败,目标或已存在');
                        })
                    }
                })
            },
            editDialog(row){
                this.DialogVisible = true;
                this.dialogTitle = '修改标签';
                this.labelForm.name = row.name;
                this.labelForm.type_id = row.type_id;
            },
            openDialog(){
                this.labelForm.name=null;
                this.labelForm.type_id=null;
                this.DialogVisible = true;
                this.dialogTitle = '新增标签';
            },
            getList(){
                this.loading = true;
                let params = {
                    name:this.filter.name,
                    type_id:this.filter.type_id,
                    page:this.currentPage,
                    pageSize:this.pageSize,
                }
                axios.get('/api/labels',{params}).then((res)=>{
                    this.tableData = res.data.data[0];
                    this.total = res.data.meta.total;
                    this.loading = false;
                })
            },
            getTypeList(){
                axios.get('/api/types').then((res)=>{
                    res.data[0].forEach((item,index)=>{
                        this.options.push({value:item.id,label:item.name});
                    })
                })
            },
            typeName(row,column){
                var res = '';
                this.options.forEach((item,index)=>{
                    if(row.type_id==item.value){
                        res = item.label;
                    }
                })
                return res;
            },
            delete1(id){
                this.$confirm('删除, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then((res)=>{
                    axios.delete('/api/labels/'+id).then((res)=>{
                        this.$message({
                            type: 'success',
                            message: '成功!'
                        });
                        this.getList();
                    })

                })
            },
            handleSizeChange(val){
                this.pageSize = val;
                this.getList();
            },
            handleCurrentChange(val){
                this.currentPage = val;
                this.getList();
            }
        },
        mounted(){
            this.getList();
            this.getTypeList();
            const userInfo = JSON.parse(sessionStorage.getItem('userInfo'));
            this.labelForm.author_id = userInfo.id;
        }
    }
</script>