// Extra icons

import { defineComponent } from 'vue'

export const MenuFoldLineRightIcon = defineComponent({
    setup() {
        return () => (
            <svg
                viewBox="0 0 24 24"
                stroke="currentColor"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M12 6H20M12 12H20M4 18H20M4 6L8 9L4 12"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        )
    },
})

export const MenuFoldLineLeftIcon = defineComponent({
    setup() {
        return () => (
            <svg
                viewBox="0 0 24 24"
                stroke="currentColor"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M12 6H20M12 12H20M4 18H20M8 6L4 9L8 12"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        )
    },
})

export const DashboardIcon = defineComponent({
    setup() {
        return () => (
            <svg
                viewBox="0 0 24 24"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path d="M5.5 12.5C5.22386 12.5 5 12.7239 5 13C5 13.2761 5.22386 13.5 5.5 13.5H7C7.27614 13.5 7.5 13.2761 7.5 13C7.5 12.7239 7.27614 12.5 7 12.5H5.5Z" />
                <path d="M6.93935 7.93935C7.13462 7.74409 7.4512 7.74409 7.64646 7.93935L8.70712 9.00001C8.90238 9.19528 8.90238 9.51186 8.70712 9.70712C8.51186 9.90238 8.19528 9.90238 8.00001 9.70712L6.93935 8.64646C6.74409 8.4512 6.74409 8.13462 6.93935 7.93935Z" />
                <path d="M17 12.5C16.7239 12.5 16.5 12.7239 16.5 13C16.5 13.2761 16.7239 13.5 17 13.5H18.5C18.7761 13.5 19 13.2761 19 13C19 12.7239 18.7761 12.5 18.5 12.5H17Z" />
                <path d="M15.4394 10.0606C15.2441 9.86538 15.2441 9.5488 15.4394 9.35354L16.5 8.29288C16.6953 8.09762 17.0119 8.09762 17.2071 8.29288C17.4024 8.48814 17.4024 8.80472 17.2071 8.99999L16.1465 10.0606C15.9512 10.2559 15.6346 10.2559 15.4394 10.0606Z" />
                <path d="M12.9661 12.741C12.9882 12.8236 13 12.9104 13 13C13 13.5523 12.5523 14 12 14C11.4477 14 11 13.5523 11 13C11 12.4477 11.4477 12 12 12C12.0896 12 12.1764 12.0118 12.259 12.0339L13 11.2929C13.1953 11.0976 13.5119 11.0976 13.7071 11.2929C13.9024 11.4881 13.9024 11.8047 13.7071 12L12.9661 12.741Z" />
                <path d="M12 8.5C11.7239 8.5 11.5 8.27614 11.5 8V6.5C11.5 6.22386 11.7239 6 12 6C12.2761 6 12.5 6.22386 12.5 6.5V8C12.5 8.27614 12.2761 8.5 12 8.5Z" />
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M12 3C9.34784 3 6.8043 4.05357 4.92893 5.92893C3.05357 7.8043 2 10.3478 2 13C2 14.3132 2.25866 15.6136 2.7612 16.8268C3.26375 18.0401 4.00035 19.1425 4.92893 20.0711C5.11647 20.2586 5.37082 20.364 5.63604 20.364H18.364C18.6292 20.364 18.8835 20.2586 19.0711 20.0711C19.9997 19.1425 20.7362 18.0401 21.2388 16.8268C21.7413 15.6136 22 14.3132 22 13C22 10.3478 20.9464 7.8043 19.0711 5.92893C17.1957 4.05357 14.6522 3 12 3ZM6.34315 7.34315C7.84344 5.84285 9.87827 5 12 5C14.1217 5 16.1566 5.84285 17.6569 7.34315C19.1571 8.84344 20 10.8783 20 13C20 14.0506 19.7931 15.0909 19.391 16.0615C19.0406 16.9075 18.5479 17.6861 17.9353 18.364H6.06469C5.45205 17.6861 4.95938 16.9075 4.60896 16.0615C4.20693 15.0909 4 14.0506 4 13C4 10.8783 4.84285 8.84344 6.34315 7.34315Z"
                />
            </svg>
        )
    },
})

export const ArrowsInnerIcon = defineComponent({
    setup() {
        return () => (
            <svg
                viewBox="0 0 24 24"
                stroke="currentColor"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M4 4L9 9M9 9V5M9 9H5M20 4L15 9M15 9V5M15 9H19M4 20L9 15M9 15H5M9 15V19M20 20L15 15M15 15H19M15 15V19"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        )
    },
})

export const EmptyCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M20.3149 15.4442C20.7672 14.3522 21 13.1819 21 12C21 9.61305 20.0518 7.32387 18.364 5.63604C16.6761 3.94821 14.3869 3 12 3C9.61305 3 7.32387 3.94821 5.63604 5.63604C3.94821 7.32387 3 9.61305 3 12C3 13.1819 3.23279 14.3522 3.68508 15.4442C4.13738 16.5361 4.80031 17.5282 5.63604 18.364C6.47177 19.1997 7.46392 19.8626 8.55585 20.3149C9.64778 20.7672 10.8181 21 12 21C13.1819 21 14.3522 20.7672 15.4442 20.3149C16.5361 19.8626 17.5282 19.1997 18.364 18.364C19.1997 17.5282 19.8626 16.5361 20.3149 15.4442Z"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        )
    },
    
})

export const Request= defineComponent({
    setup() {
        return () => (
            <svg class="w-6 h-6 text-gray-500 dark:text-white-200" 
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" 
                fill="currentColor" 
                viewBox="0 0 20 18">

            <path 
                d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.546l3.2 3.659a1 1 0 0 0 1.506 0L13.454 14H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-8 10H5a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Zm5-4H5a1 1 0 0 1 0-2h10a1 1 0 1 1 0 2Z"/>
        </svg>
        )
    },
    
})
export const Requests= defineComponent({
    setup() {
        return () => (
            <svg class="w-6 h-6 text-gray-500 dark:text-white-200" 
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 20 20">
            
            <path fill="currentColor" 
                d="M8 1V0v1Zm4 0V0v1Zm2 4v1h1V5h-1ZM6 5H5v1h1V5Zm2-3h4V0H8v2Zm4 0a1 1 0 0 1 .707.293L14.121.879A3 3 0 0 0 12 0v2Zm.707.293A1 1 0 0 1 13 3h2a3 3 0 0 0-.879-2.121l-1.414 1.414ZM13 3v2h2V3h-2Zm1 1H6v2h8V4ZM7 5V3H5v2h2Zm0-2a1 1 0 0 1 .293-.707L5.879.879A3 3 0 0 0 5 3h2Zm.293-.707A1 1 0 0 1 8 2V0a3 3 0 0 0-2.121.879l1.414 1.414ZM2 6h16V4H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v12h2V6h-2Zm0 12v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V6H0v12h2ZM2 6V4a2 2 0 0 0-2 2h2Zm16.293 3.293C16.557 11.029 13.366 12 10 12c-3.366 0-6.557-.97-8.293-2.707L.293 10.707C2.557 12.971 6.366 14 10 14c3.634 0 7.444-1.03 9.707-3.293l-1.414-1.414ZM10 9v2a2 2 0 0 0 2-2h-2Zm0 0H8a2 2 0 0 0 2 2V9Zm0 0V7a2 2 0 0 0-2 2h2Zm0 0h2a2 2 0 0 0-2-2v2Z"/>
    </svg>
        )
    },
})
    export const TobeApprove = defineComponent({
        setup() {
            return () => (
            <svg class="w-6 h-6 text-gray-800 dark:text-white" 
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" 
            fill="currentColor" 
            viewBox="0 0 17 14">
                <path d="M16 2H1a1 1 0 0 1 0-2h15a1 1 0 1 1 0 2Zm0 6H1a1 1 0 0 1 0-2h15a1 1 0 1 1 0 2Zm0 6H1a1 1 0 0 1 0-2h15a1 1 0 0 1 0 2Z"/>
            </svg>
            )
        },    
    
    })
    export const Dashboard = defineComponent({
        setup() {
            return () => (
            <svg class="w-6 h-6 text-gray-800 dark:text-white" 
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" 
            fill="currentColor" 
            viewBox="0 0 20 16">
            <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z"/>
        </svg>
            )
        },        
})

export const RequestsReg = defineComponent({
    setup() {
        return () => (
            <svg class="w-6 h-6 text-gray-800 dark:text-white" 
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" 
            fill="currentColor" 
            viewBox="0 0 18 20">
            <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
        </svg>
        )
    },        
})
