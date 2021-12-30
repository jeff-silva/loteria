<template>
    <div>
        <el-tabs type="border-card" tab-position="left">
            <el-tab-pane :label="c.cname" v-for="c in cnames" :key="c.cname">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <a href="javascript:;" :class="`btn btn-${c.cname} w-100`">aa</a>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <a href="javascript:;" :class="`btn btn-outline-${c.cname} w-100`">aa</a>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div :class="`bg-${c.cname} p-2`">aa</div>
                    </div>
                    
                    <div class="col-12 col-md-6 mb-3">
                        <div :class="`border border-${c.cname} p-2`">aa</div>
                    </div>
                    
                    <div class="col-12 col-md-6 mb-3">
                        <ul class="list-group">
                            <li :class="`list-group-item list-group-item-${c.cname}`">A simple primary list group item</li>
                            <li :class="`list-group-item list-group-item-${c.cname}`">A simple primary list group item</li>
                            <li :class="`list-group-item list-group-item-${c.cname}`">A simple primary list group item</li>
                        </ul>
                    </div>
                    
                    <div class="col-12 col-md-6 mb-3">
                        <table :class="`table table-${c.cname} table-striped`">
                            <tbody>
                                <tr><td>Item</td><td>Item</td><td>Item</td></tr>
                                <tr><td>Item</td><td>Item</td><td>Item</td></tr>
                                <tr><td>Item</td><td>Item</td><td>Item</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Bootstrap",
        };
    },

    data() {
        return {
            cnames: [
                {cname:"primary"},
                {cname:"secondary"},
                {cname:"success"},
                {cname:"danger"},
                {cname:"info"},
                {cname:"warning"},
            ],
        };
    }
}
</script>