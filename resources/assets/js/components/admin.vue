<template>
    <el-container style="height:100%; border: 1px solid #eee;">
        <el-header style="text-align: right; font-size: 12px">
            <div v-show="!collapse" style="float: left;font-size: 22px;text-align: center;width: 200px;border-right:1px solid gold; ">
                <span >beauty</span>
            </div>
            <div :class="collapse?'right-gold':''" style="float: left;font-size: 22px;text-align:center;width: 64px;">
                <a href="javascript:;" @click="collapse=!collapse" style="color:white;">
                    <i class="el-icon-menu"></i>
                </a>
            </div>
            <div style="padding-right: 35px">
                <el-dropdown>
                    <span class="el-dropdown-link userinfo-inner"><img :src="this.sysUserAvatar" /> {{sysUserName}}</span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item>查看</el-dropdown-item>
                        <el-dropdown-item @click.native="logout">退出登录</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </div>
        </el-header>
        <el-container>
            <div :class="collapse?'aside-collapse':'aside'">
                <el-menu
                        background-color="#F4F9FF"
                        active-text-color="#46A0FC"
                        :collapse="collapse"
                        v-for="(item,index) in $router.options.routes"
                        :key="index"
                        :router="true"
                        :default-active="$route.path"
                >
                    <el-submenu :index="item.path" v-if="!item.hidden">
                        <template slot="title">
                            <i class="el-icon-message"></i>
                            <span slot="title">{{item.name}}</span>
                        </template>
                        <el-menu-item-group v-for="(item2,index2) in item.children" :key="index2">
                            <el-menu-item v-if="!item2.hidden" :index="item2.path">{{item2.name}}</el-menu-item>
                        </el-menu-item-group>
                    </el-submenu>
                </el-menu>
            </div>
            <el-main>
                <transition name="fade">
                    <router-view></router-view>
                </transition>
            </el-main>
        </el-container>
    </el-container>
</template>


<style>
    /*.el-main{background-color: #F4F9FF}*/
    .el-header {  background-color: #46A0FC;  color: white;  line-height: 60px; padding:0px; }
    .aside{color: #333;background-color:#F4F9FF;width:200px;}
    .aside-collapse{color: #333;background-color:#F4F9FF;width:64px;}
    .el-menu{border: 0px;}
    .el-submenu .el-menu{margin-left:0px!important;}
    .el-menu-item-group__title{padding:0px;}
    .right-gold{border-right:1px solid gold;}
    .userinfo-inner{  color: white;  }
    .userinfo-inner  img {  width: 40px;  height: 40px;  border-radius: 20px;  margin: 10px 0px 10px 10px;  float: right;  }
</style>

<script>
    export default {
        data() {
            const item = {
                date: '2016-05-02',
                name: '王小虎',
                address: '上海市普陀区金沙江路 1518 弄'
            };
            return {
                tableData: Array(20).fill(item),
                collapse:false,
//                sysUserAvatar:'../../images/default.jpg',
                sysUserAvatar:'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80',
                sysUserName:'beauty',
            }
        },
        methods:{
            logout(){
                this.$confirm('退出, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    sessionStorage.removeItem('access_token');
                    this.$message({
                        type: 'success',
                        message: '成功!'
                    });
                    this.$router.push('/login');
                }).catch(() => {

                });
            }
        },
        mounted(){
            //getUserInfo
            axios.get('/api/user').then((res)=>{
                sessionStorage.setItem('userInfo',JSON.stringify(res.data));
                this.sysUserName = res.data.name;
            })
        }


    };
</script>