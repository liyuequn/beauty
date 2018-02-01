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
                    <el-input v-model="filter.name" placeholder="书名" @keyup.enter.native="getList()" ></el-input>
                </el-col>
                <el-col :span="2">
                    <el-button type="primary" plain @click="getList()">搜索</el-button>
                </el-col>
                <el-col :span="6">
                    <el-button type="primary" plain @click="openDialog('bookForm')">上传书籍</el-button>
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
                    label="书籍"
            >
            </el-table-column>
            <el-table-column
                    prop="path"
                    label="下载"
            >
                <template slot-scope="scope">
                    <a :href="scope.row.path">下载</a>
                </template>
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="操作"
            >
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
                width="45%"
                center>

            <el-form :model="bookForm" status-icon ref="bookForm" :rules="rules">
                <el-form-item label="书名">
                    <el-form-item  prop="name" required  placeholder="请填写书籍名称">
                        <el-input v-model="bookForm.name" auto-complete="off"></el-input>
                    </el-form-item>
                </el-form-item>
                <el-form-item label="标签">
                    <el-form-item  prop="name" required  placeholder="请填写书籍名称">
                        <el-input v-model="bookForm.label" auto-complete="off"></el-input>
                    </el-form-item>
                </el-form-item>
                <el-form-item label="摘要">
                    <el-form-item  prop="name" required  placeholder="摘要">
                        <el-input type="textarea" v-model="bookForm.description" auto-complete="off"></el-input>
                    </el-form-item>
                </el-form-item>
                <el-form-item label="上传">
                        <el-upload
                                class="upload-demo"
                                action="/api/v1/files"
                                :before-remove="beforeRemove"
                                :limit="1"
                                :on-success="getPath"
                                :on-exceed="handleExceed">
                            <el-button size="small" type="primary">点击上传</el-button>
                            <div slot="tip" class="el-upload__tip">只能上传pdf文件，且不超过50M</div>
                        </el-upload>
                </el-form-item>
            </el-form>

            <span slot="footer" class="dialog-footer">
                <el-button @click="DialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="confirm('bookForm')">确 定</el-button>
            </span>
        </el-dialog>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                DialogVisible:false,
                dialogTitle:'书籍',
                loading:false,
                filter:{
                    type:null,
                    name:null,
                },
                options:[],
                tableData: [],
                fileList: [
                    {
                        name: '《深入浅出》',
                        url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
                    },
                    {
                        name: '《mysql》',
                        url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
                    }],
                //page
                total:0,
                currentPage:1,
                pageSize:10,
                //addType
                bookForm:{
                    name:null,
                    description:null,
                    label:null,
                    path:null,
                },
                rules: {
                    name: [
                        { required: true, message: '不能为空', trigger: 'blur' },
                    ],
                },
            }
        },
        methods:{
            getPath:function (response, file, fileList) {
                this.bookForm.path = response;
            },
            confirm(formName){
                this.$refs[formName].validate((valid) => {
                    if(valid){
                        this.DialogVisible = false;
                        axios.post('/api/v1/books',this.bookForm).then((res)=>{
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
                this.dialogTitle = '修改书籍';
                this.bookForm.name = row.name;
            },
            openDialog(){
                this.DialogVisible = true;
                this.dialogTitle = '上传书籍';
            },
            getList(){
                this.loading = true;
                let params = {
                    name:this.filter.name,
                    page:this.currentPage,
                    pageSize:this.pageSize,
                }
                axios.get('/api/v1/books',{params}).then((res)=>{
                    this.loading = false;
                    this.tableData = res.data;
                    console.log(res)
//                    this.total = res.data.meta.total;
                })
            },
            delete1(id){
                this.$confirm('删除, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then((res)=>{
                    axios.delete('/api/v1/books/'+id).then((res)=>{
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
            },
            beforeRemove(){

            },
            //超出上传时限制
            handleExceed(){
                console.log('超出上传时限制')
            }
        },
        mounted(){
            this.getList();
            const userInfo = JSON.parse(sessionStorage.getItem('userInfo'));
            this.bookForm.author_id = userInfo.id;
        }
    }
</script>