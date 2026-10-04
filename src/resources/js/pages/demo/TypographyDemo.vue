<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import Card from "@/core/components/Card.vue";

const props = defineProps<{}>();
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-wrap lg:flex-nowrap justify-center gap-2">
        <Card title="Headers">
            <h1>H1 Header</h1>
            <h2>H2 Header</h2>
            <h3>H3 Header</h3>
            <h4>H4 Header</h4>
            <h5>H5 Header</h5>
            <h6>H6 Header</h6>
            <p>Paragraph</p>
        </Card>
        <Card title="Formatting">
            <div>
                <a href="#">Standard Link</a>
                <pre>Unformatted Pre Block</pre>
                <code>Code Block</code>
                <blockquote>Blockquote</blockquote>
            </div>
        </Card>
        <Card title="Text Variants">
            <p>Add the class to the text for the necessary color variant</p>
            <p class="text-success">.text-success</p>
            <p class="text-warning">.text-warning</p>
            <p class="text-muted">.text-muted</p>
            <p class="text-error">.text-error</p>
            <p class="text-danger">.text-danger</p>
        </Card>
        <Card title="Basic Lists">
            <div class="flex flex-col gap-2">
                <div>
                    <h5 class="border-b border-b-slate-300">Unstyled List</h5>
                    <ul>
                        <li>List Item 1</li>
                        <li>List Item 2</li>
                    </ul>
                </div>
                <div>
                    <h5 class="border-b border-b-slate-300">Styled List</h5>
                    <ul class="list-disc list-inside">
                        <li>List Item 1</li>
                        <li>List Item 2</li>
                    </ul>
                </div>
                <div>
                    <h5 class="border-b border-b-slate-300">Ordered List</h5>
                    <ol class="list-decimal list-inside">
                        <li>Ordered Item 1</li>
                        <li>Ordered Item 2</li>
                    </ol>
                </div>
            </div>
        </Card>
    </div>
</template>
