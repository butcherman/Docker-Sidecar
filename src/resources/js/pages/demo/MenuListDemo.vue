<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import MenuList from "@/core/components/MenuList.vue";

const exampleMenu = [
    {
        label: "Home Page",
        icon: "home",
        route: "#",
    },
    {
        label: "User Account",
        icon: "user",
        route: "#",
    },
    {
        label: "Settings",
        icon: "cog",
        route: "#",
    },
];

const referenceProperties = [
    {
        property: "menuList",
        type: "MenuItem[]",
        default: "",
        required: true,
        description: "List of navigation links.",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">List of navigation links.</p>
        </Card>
        <div class="flex flex-col lg:flex-row gap-2">
            <Card title="Example Data">
                <div class="mt-3 p-3 bg-slate-300 rounded-lg overflow-auto">
                    const exampleMenu = [<br />
                    &emsp;{<br />
                    &emsp;&emsp;label: "Home Page",<br />
                    &emsp;&emsp;icon: "home",<br />
                    &emsp;&emsp;route: "#",<br />
                    &emsp;},<br />
                    &emsp;{<br />
                    &emsp;&emsp;label: "User Account",<br />
                    &emsp;&emsp;icon: "user",<br />
                    &emsp;&emsp;route: "#",<br />
                    &emsp;},<br />
                    &emsp;{<br />
                    &emsp;&emsp;label: "Settings",<br />
                    &emsp;&emsp;icon: "cog",<br />
                    &emsp;&emsp;route: "#",<br />
                    &emsp;},<br />
                    ];
                </div>
            </Card>
            <ExampleComponent show>
                <template #component>
                    <div class="flex justify-center">
                        <MenuList
                            :menu-list="exampleMenu"
                            class="border border-slate-300 rounded-lg"
                        />
                    </div>
                </template>
                <template #code>
                    &lt;script setup&gt; <br />
                    &emsp;import Collapse from
                    "@/core/components/MenuList.vue"<br />
                    &lt;/script&gt;<br />
                    <br />
                    &lt;template&gt;<br />
                    &emsp;&lt;MenuList :menu-list="exampleMenu" /&gt;<br />
                    &lt;/template&gt;<br />
                </template>
            </ExampleComponent>
        </div>
        <ComponentReference :reference-properties="referenceProperties" />
    </div>
</template>
