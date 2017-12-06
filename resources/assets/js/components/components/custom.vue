<style>
    .components{
        border:1px solid green;
        height:100%;
        padding: 10px 10px 0px 10px;
        line-height:3;
    }
    .phone{
        border:1px solid green;
        height:100%;
    }
    .components-control{
        border:1px solid green;
        height:100%;
    }
    .height-100{
        height: 100%;
    }
    .cus-btn{
        width: 100px;
    }
</style>
<template>
    <div class="height-100">
        <div style="height: 100px;">

        </div>
        <el-row class="height-100" :gutter="30">
            <el-col :span="8" class="height-100">
                <div class="components">
                    <div v-for="item in btns" style="float:left;margin-left:5px;" :key="item.value">
                        <el-button class="cus-btn" draggable="true" type="success" plain>
                            {{item.label}}
                        </el-button>
                    </div>
                </div>
            </el-col>
            <el-col :span="8" class="height-100">
                <div class="phone">

                </div>
            </el-col>
            <el-col :span="8" class="height-100">
                <div class="components-control">

                </div>
            </el-col>
        </el-row>
        <div style="height: 100px;">

        </div>

    </div>
</template>
<script>
    import draggable from 'vuedraggable'
    export default{
        components: {
            draggable
        },
        data(){
            return {
                btns:[
                    {value:1,label:'文本框'},
                    {value:2,label:'提交'},
                    {value:3,label:'选择框'},
                    {value:4,label:'单选框'},
                    {value:5,label:'单选框'},
                    {value:6,label:'单选框'},
                    {value:7,label:'单选框'},
                    {value:8,label:'单选框'},
                ],
            }
        },
        methods: {
            getdata (evt) {
                console.log(evt.draggedContext.item)
            },
            datadragEnd (evt) {
                console.log('拖动前的索引 :' + evt.oldIndex)
                console.log('拖动后的索引 :' + evt.newIndex)
                console.log(this.tags)
            }
        }
    }
</script>