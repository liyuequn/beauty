<template>
    <div>
            <el-form :model="article" :rules="rules" ref="ruleForm">
                <div class="search-bar">
                <el-row :gutter="20">
                    <el-col :md="5" class="el-form-item-md">
                        <el-form-item prop="type">
                            <el-select style="width:100%;" v-model="article.type" placeholder="文章分类">
                                <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :md="5" class="el-form-item-md">
                        <el-form-item prop="title">
                            <el-input v-model="article.title" placeholder="标题"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :md="5" class="el-form-item-md">
                        <el-form-item prop="title">
                            <el-input v-model="article.label" placeholder="标签,请以逗号,隔开"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :md="5" class="el-form-item-md">
                        <div class="block">
                            <el-date-picker
                                    style="width:100%"
                                    v-model="article.post_at"
                                    type="datetime"
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    placeholder="发表时间">
                            </el-date-picker>
                        </div>
                    </el-col>
                </el-row>
                </div>

                <div class='simplemde-container' :style="{height:'40%',zIndex:zIndex}">
                    <el-form-item prop="content">
                        <textarea :id='id' v-model="article.content">
                        </textarea>
                    </el-form-item>
                </div>
                <input type="file" id="btn_file" style="display:none">
            </el-form>
            <div class="btn-post" style="position:relative;z-index:100;text-align:right;margin-top:100px;">
                <el-button type="primary" @click="save()" :loading="saveLoading" plain>保存</el-button>
                <el-button type="primary" @click="submit()" :loading="submitLoading" plain>发表</el-button>
            </div>

    </div>

</template>

<script>
    import 'simplemde/dist/simplemde.min.css'
    import SimpleMDE from 'simplemde'
    export default {
        name: 'simplemde-md',
        props: {
            id:{
                type: String,
                default: 'editor'
            },
            value: String,
            autofocus: {
                type: Boolean,
                default: false
            },
            placeholder: {
                type: String,
                default: ''
            },
            height: {
                type: Number,
                default: 150
            },
            zIndex: {
                type: Number,
                default: 10
            },
            toolbar: {
                type: Array
            }
        },
        data() {
            return {
                time_now:'',
                article:{
                    id:null,
                    post_at:'',
                    label:'',
                    title:'',
                    type:'',
                    content:'',
                    author_id:'',
                },
                userInfo:{},
                options:[],
                simplemde: null,
                hasChange: false,
                saveLoading:false,
                submitLoading:false,
                ruleForm: {
                    title: '',
                    type: '',
                    content:'',
                },
                rules: {
                    title: [
                        { required: true, message: '请输入标题', trigger: 'blur' },
                    ],
                    type: [
                        {type:'number',required: true, message: '请选择文章类型', trigger: 'blur' },
                    ],
                    content: [
                        { required: true, message: '文章内容不能为空', trigger: 'blur' },
                    ],
                },
            }
        },
        methods:{
            save(){
                this.article.content=this.simplemde.value();
                this.$refs.ruleForm.validate((valid) => {
                    if(valid){
                        var _this = this;
                        this.saveLoading = true;
                        let params = this.article;
                        axios.post('/api/v1/articles',params).then((res)=>{
                            if(res.status==200){
                                this.saveLoading = false;
                                this.article = res.data;
                                _this.$message({
                                    showClose: true,
                                    message: '保存成功',
                                    type: 'success'
                                })
                            }
                        }).catch((error)=>{
                            this.saveLoading = false;
                            _this.$message({
                                showClose: true,
                                message:'error',
                                type: 'error'
                            })
                        })
                    }
                })
            },
            submit(){
                this.article.content=this.simplemde.value();
                this.$refs.ruleForm.validate((valid) => {
                    if(valid){
                        var _this = this;
                        this.submitLoading = true;
                        let params = this.article;
                        axios.post('/api/v1/articles',params).then((res)=>{
                            if(res.status==200){
                                this.submitLoading = false;
                                this.article = res.data;
                                _this.$message({
                                    showClose: true,
                                    message: '成功',
                                    type: 'success'
                                })
                                this.$router.push('/articles/'+this.article.id)
                            }
                        }).catch((error)=>{
                            console.log(error)
                            this.submitLoading = false;
                            _this.$message({
                                showClose: true,
                                message:'error',
                                type: 'error'
                            })
                        })
                    }
                })
            },
            detail(id){
                axios.get('/api/v1/articles/'+id).then((res)=>{
                    this.article = res.data;
                    this.simplemde.value(res.data.content);
                })
            },
            getTypeList(){
                axios.get('/api/v1/types').then((res)=>{
                    res.data[0].forEach((item,index)=>{
                        this.options.push({value:item.id,label:item.name});
                    })
                })
            },
            selectImage(editor) {
                var fileBtn = document.getElementById("btn_file");
                fileBtn.onchange = this.uploadImage;
                fileBtn.click();
            },
            uploadImage() {
                var fileBtn = document.getElementById("btn_file");
                var formData = new FormData();
                formData.append("file", fileBtn.files[0]);
                axios.post('/api/v1/image/upload', formData).then(({data}) => {

                    var pos = this.simplemde.codemirror.getCursor();
                    this.simplemde.codemirror.setSelection(pos, pos);
                    this.simplemde.codemirror.replaceSelection('![](' + data.data.image + ')');

                    console.log(data);

                });
                console.log(fileBtn.files[0]);
                console.log(1);
            },
        },
        watch: {
            value(val) {
                if (val === this.simplemde.value() && !this.hasChange) return
                this.simplemde.value(val)
            }
        },
        mounted() {
            this.article.author_id = sessionStorage.getItem('userId');
            this.getTypeList();
            var time = new Date();
            var month = time.getMonth()+1;
            this.article.post_at =
                time.getFullYear()+'-'+
                month +'-'+
                time.getDate()+' '+
                time.getHours()+':'+
                time.getMinutes()+':'+
                time.getSeconds();

            this.simplemde = new SimpleMDE({
                element: document.getElementById(this.id),
                autofocus: this.autofocus,
                toolbar: this.toolbar,
                spellChecker: false,
                insertTexts: {
                    link: ['[', ']( )']
                },
                //hideIcons: ['guide', 'heading', 'quote', 'image', 'preview', 'side-by-side', 'fullscreen'],
                showIcons: ["code", "table"],
                placeholder: this.placeholder
            })
            if (this.value) {
                this.simplemde.value(this.value)
            }
            this.simplemde.codemirror.on('change', () => {
                if (this.hasChange) {
                    this.hasChange = true
                }
                this.$emit('input', this.simplemde.value())
            })
            this.simplemde.codemirror.on('beforeChange', () => {
                console.log(this.simplemde.value());
//                this.selectImage();
            })
            var arr = window.location.href.split('/');
            if(arr.length==6){
                this.detail(arr[5]);
            }
            if(!arr[arr.length]=='write'){
                if(this.$route.params.id){
                    this.detail(this.$route.params.id);
                }
            }
        },
        destroyed() {
            this.simplemde = null;
        }
    }
</script>

<style>
    .simplemde-container .CodeMirror {
        /*height: 150px;*/
        min-height: 250px;
    }
    .simplemde-container .CodeMirror-scroll {
        min-height: 250px;
    }
    .simplemde-container .CodeMirror-code {
        padding-bottom: 40px;
    }
    .simplemde-container .editor-statusbar {
        display: none;
    }
    .simplemde-container .CodeMirror .CodeMirror-code .cm-link {
        color: #1482F0;
    }
    .simplemde-container .CodeMirror .CodeMirror-code .cm-string.cm-url {
        color: #2d3b4d;
        font-weight: bold;
    }
    .simplemde-container .CodeMirror .CodeMirror-code .cm-formatting-link-string.cm-url {
        padding: 0 2px;
        font-weight: bold;
        color: #E61E1E;
    }
    .search-bar{
        width:100%;height:auto;
        background-color:#F4F9FF;
        display:block;
        padding:20px 20px 0px 20px;
        margin-bottom:20px;
    }
    .el-form-item{
        margin-bottom: 0px;
    }
    .el-form-item-md{
        margin-bottom: 22px;
    }
</style>


