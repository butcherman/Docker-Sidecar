<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import Card from "@/core/components/Card.vue";
import Collapse from "@/core/components/Collapse.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExpandBadge from "@/core/components/badges/ExpandBadge.vue";
import { ref } from "vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";

const exampleCollapse = ref(true);

const referenceProperties = [
    {
        property: "show",
        type: "boolean",
        default: "",
        required: true,
        description:
            "When true, content will be shown, when false content will be hidden",
    },
];
const slotProperties = [
    {
        name: "default",
        params: "",
        description: "Collapsable content",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">
                Collapsable content wrapper with animation for a smooth
                transition.
            </p>
        </Card>
        <ExampleComponent>
            <template #component>
                <Card title="Example" size="md">
                    <template #append-title>
                        <ExpandBadge
                            :expanded="exampleCollapse"
                            @click="exampleCollapse = !exampleCollapse"
                        />
                    </template>
                    <Collapse :show="exampleCollapse">
                        Use the badge in the header to expand and collapse this
                        component.
                    </Collapse>
                </Card>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import Collapse from "@/core/components/Collapse.vue"<br />
                <br />
                &emsp;const exampleCollapse = ref(true);<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;Card title="Example"&gt;<br />
                &emsp;&emsp;&lt;template #append-title&gt; <br />
                &emsp;&emsp;&emsp;&lt;ExpandBadge<br />
                &emsp;&emsp;&emsp;&emsp;:expanded="exampleCollapse"<br />
                &emsp;&emsp;&emsp;&emsp;@click="exampleCollapse =
                !exampleCollapse"<br />
                &emsp;&emsp;&emsp;/&gt;
                <br />
                &emsp;&emsp;&lt;/template&gt;<br />
                &emsp;&emsp;&lt;Collapse :show="exampleCollapse"&gt;
                <div class="ms-12">
                    Use the badge in the header to expand and collapse this
                    component.
                </div>
                &emsp;&emsp;&lt;/Collapse&gt; <br />
                &emsp;&lt;/Card&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>

        <ComponentReference
            :reference-properties="referenceProperties"
            :slot-properties="slotProperties"
        />
    </div>
</template>
