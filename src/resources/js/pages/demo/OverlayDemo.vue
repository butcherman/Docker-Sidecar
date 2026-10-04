<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseButton from "@/core/components/buttons/BaseButton.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import MenuList from "@/core/components/MenuList.vue";
import Overlay from "@/core/components/Overlay.vue";
import { ref } from "vue";

const showLoader = ref(true);
const showFullPageLoader = ref(false);

const timer = ref(5);

const onShowFullPage = () => {
    showFullPageLoader.value = true;
    let countdown = setInterval(() => {
        timer.value--;

        if (timer.value <= 0) {
            clearInterval(countdown);
            timer.value = 5;
            showFullPageLoader.value = false;
        }
    }, 1000);
};

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
        property: "loading",
        type: "boolean",
        default: "false",
        required: true,
        description: "Determines if the loader is shown or not",
    },
    {
        property: "fullPage",
        type: "boolean",
        default: "fasle",
        required: false,
        description:
            "When true, the loader will take over the page rather than stay in its container",
    },
    {
        property: "loadingText",
        type: "string",
        default: "",
        required: false,
        description: "Text to show under the loader animation",
    },
];

const slotProperties = [
    {
        name: "loader",
        params: "",
        description: "Replace the loader animation with custom content",
    },
    {
        name: "default",
        params: "",
        description: "Content to be shown when loader is false",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">Loading overlay that covers content</p>
        </Card>
        <ExampleComponent title="Basic Example">
            <template #component>
                <div class="text-center">
                    <BaseButton
                        text="Toggle Loader"
                        @click="showLoader = !showLoader"
                    />
                </div>
                <div>
                    <Overlay :loading="showLoader" loading-text="Loading...">
                        <MenuList
                            :menu-list="exampleMenu"
                            class="border border-slate-300 rounded-lg"
                        />
                    </Overlay>
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import Overlay from "@/core/components/Overlay.vue"<br />
                <br />
                const showLoader = ref(true);<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;Overlay :loading="showLoader"
                loading-text="Loading..."&gt;<br />
                &emsp;&emsp;&lt;MenuList :menu-list="exampleMenu" /&gt;<br />
                &emsp;&lt;Overlay /&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ExampleComponent title="Full Page Overlay">
            <template #component>
                <div class="text-center">
                    <BaseButton text="Toggle Loader" @click="onShowFullPage" />
                </div>
                <div>
                    <Overlay
                        :loading="showFullPageLoader"
                        :loading-text="`${timer} seconds left`"
                        full-page
                    >
                        <MenuList
                            :menu-list="exampleMenu"
                            class="border border-slate-300 rounded-lg"
                        />
                    </Overlay>
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import Overlay from "@/core/components/Overlay.vue"<br />
                <br />
                const showLoader = ref(true);<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;Overlay <br />
                &emsp;&emsp;:loading="showLoader"<br />
                &emsp;&emsp;:loading-text="`${timer} seconds left`"<br />
                &emsp;&emsp;full-page<br />
                &emsp;&gt;<br />

                &emsp;&emsp;&lt;MenuList :menu-list="exampleMenu" /&gt;<br />
                &emsp;&lt;Overlay /&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ComponentReference
            :reference-properties="referenceProperties"
            :slot-properties="slotProperties"
        />
    </div>
</template>
