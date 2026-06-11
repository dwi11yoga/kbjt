// import "./bootstrap";
import { createIcons, icons } from "lucide";
import { toJavanese, toLatin } from "carakanjs";

// dakmode
if (localStorage.theme === "dark") {
    document.documentElement.classList.add("dark");
} else {
    document.documentElement.classList.remove("dark");
}

// fungsitoggle darkmode
window.darkmodeToggle = function () {
    if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark");
        localStorage.theme = "light";
    } else {
        document.documentElement.classList.add("dark");
        localStorage.theme = "dark";
    }
};

// custom icon lucide
const Facebook = [
    [
        "path",
        {
            d: "M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z",
        },
    ],
];
const Twitter = [
    [
        "path",
        {
            d: "M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z",
        },
    ],
];

const Instagram = [
    ["rect", { width: "20", height: "20", x: "2", y: "2", rx: "5", ry: "5" }],
    ["path", { d: "M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" }],
    ["line", { x1: "17.5", x2: "17.51", y1: "6.5", y2: "6.5" }],
];

const Tiktok = [
    [
        "path",
        {
            d: "M16.463 2.095h-3.445v13.672A2.9 2.9 0 1 1 11 13V9.5a6.33 6.33 0 1 0 5.463 6.268V8.782a8.2 8.2 0 0 0 4.773 1.526V6.885a4.83 4.83 0 0 1-4.773-4.349z",
        },
    ],
];

const Whatsapp = [
    [
        "path",
        {
            "fill-rule": "nonzero",
            d: "M2.004 22l1.352-4.968A9.954 9.954 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.954 9.954 0 0 1-5.03-1.355L2.004 22zM8.391 7.308a.961.961 0 0 0-.371.1 1.293 1.293 0 0 0-.294.228c-.12.113-.188.211-.261.306A2.729 2.729 0 0 0 6.9 9.62c.002.49.13.967.33 1.413.409.902 1.082 1.857 1.971 2.742.214.213.423.427.648.626a9.448 9.448 0 0 0 3.84 2.046l.569.087c.185.01.37-.004.556-.013a1.99 1.99 0 0 0 .833-.231c.166-.088.244-.132.383-.22 0 0 .043-.028.125-.09.135-.1.218-.171.33-.288.083-.086.155-.187.21-.302.078-.163.156-.474.188-.733.024-.198.017-.306.014-.373-.004-.107-.093-.218-.19-.265l-.582-.261s-.87-.379-1.401-.621a.498.498 0 0 0-.177-.041.482.482 0 0 0-.378.127v-.002c-.005 0-.072.057-.795.933a.35.35 0 0 1-.368.13 1.416 1.416 0 0 1-.191-.066c-.124-.052-.167-.072-.252-.109l-.005-.002a6.01 6.01 0 0 1-1.57-1c-.126-.11-.243-.23-.363-.346a6.296 6.296 0 0 1-1.02-1.268l-.059-.095a.923.923 0 0 1-.102-.205c-.038-.147.061-.265.061-.265s.243-.266.356-.41a4.38 4.38 0 0 0 .263-.373c.118-.19.155-.385.093-.536-.28-.684-.57-1.365-.868-2.041-.059-.134-.234-.23-.393-.249-.054-.006-.108-.012-.162-.016a3.385 3.385 0 0 0-.403.004z",
        },
    ],
];

const Telegram = [
    [
        "path",
        {
            d: "M19.777 4.43a1.5 1.5 0 0 1 2.062 1.626l-2.268 13.757a2 2 0 0 1-2.893 1.427 59 59 0 0 1-3.89-2.294c-.68-.445-2.763-1.87-2.507-2.884.22-.867 3.72-4.125 5.72-6.062.785-.761.427-1.2-.5-.5-2.302 1.738-5.998 4.381-7.22 5.125-1.078.656-1.64.768-2.312.656-1.226-.204-2.363-.52-3.291-.905-1.254-.52-1.193-2.244-.001-2.746z",
        },
    ],
];

const Linkedin = [
    ["path", { d: "M10 14a6 6 0 0 1 12 0v7h-4v-7a2 2 0 0 0-4 0v7h-4z" }],
    ["circle", { cx: "4", cy: "4", r: "2" }],
    ["rect", { x: "2", y: "9", width: "4", height: "12" }],
];

const Github = [
    [
        "path",
        {
            d: "M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5a5.4 5.4 0 0 0-1-3.5A7.4 7.4 0 0 0 19 2s-1 0-3 1.5a21.5 21.5 0 0 0-8 0C6 2 5 2 5 2a7 7 0 0 0 0 3.5A5.4 5.4 0 0 0 4 9c0 3.5 3 5.5 6 5.5a4.7 4.7 0 0 0-.85 1.65A4.8 4.8 0 0 0 9 18v4",
        },
    ],
    [
        "path",
        {
            d: "M9 18c-4.51 2-5-2-7-2",
        },
    ],
];

const Discord = [
    [
        "path",
        {
            d: "M18.59 5.88997C17.36 5.31997 16.05 4.89997 14.67 4.65997C14.5 4.95997 14.3 5.36997 14.17 5.69997C12.71 5.47997 11.26 5.47997 9.83001 5.69997C9.69001 5.36997 9.49001 4.95997 9.32001 4.65997C7.94001 4.89997 6.63001 5.31997 5.40001 5.88997C2.92001 9.62997 2.25001 13.28 2.58001 16.87C4.23001 18.1 5.82001 18.84 7.39001 19.33C7.78001 18.8 8.12001 18.23 8.42001 17.64C7.85001 17.43 7.31001 17.16 6.80001 16.85C6.94001 16.75 7.07001 16.64 7.20001 16.54C10.33 18 13.72 18 16.81 16.54C16.94 16.65 17.07 16.75 17.21 16.85C16.7 17.16 16.15 17.42 15.59 17.64C15.89 18.23 16.23 18.8 16.62 19.33C18.19 18.84 19.79 18.1 21.43 16.87C21.82 12.7 20.76 9.08997 18.61 5.88997H18.59ZM8.84001 14.67C7.90001 14.67 7.13001 13.8 7.13001 12.73C7.13001 11.66 7.88001 10.79 8.84001 10.79C9.80001 10.79 10.56 11.66 10.55 12.73C10.55 13.79 9.80001 14.67 8.84001 14.67ZM15.15 14.67C14.21 14.67 13.44 13.8 13.44 12.73C13.44 11.66 14.19 10.79 15.15 10.79C16.11 10.79 16.87 11.66 16.86 12.73C16.86 13.79 16.11 14.67 15.15 14.67Z",
            "stroke-width": "0",
        },
    ],
];

const customIcon = {
    ...icons,
    Facebook: Facebook,
    Twitter: Twitter,
    Instagram: Instagram,
    Tiktok: Tiktok,
    Whatsapp: Whatsapp,
    Telegram: Telegram,
    Linkedin: Linkedin,
    Github: Github,
    Discord: Discord,
};

// tampilkan icon lucide saat halaman pertama kali dimuat
document.addEventListener("DOMContentLoaded", () => {
    createIcons({
        icons: customIcon,
    });
});

// tampilkan icon lucide (promise)
const obs = new MutationObserver(() => {
    clearTimeout(window.__lucideDebounce);
    window.__lucideDebounce = setTimeout(() => {
        createIcons({
            icons: customIcon,
        });
    }, 50);
});

obs.observe(document.body, {
    childList: true,
    subtree: true,
});

// CONVERT LATIN KE AKSARA JAWA OTOMATIS
window.convertToJavanese = function (text) {
    return toJavanese(text, {
        useAccents: true,
    });
};
// CONVERT AKSARA JAWA KE LATIN OTOMATIS
window.convertToLatin = function (text) {
    return toLatin(text);
};

// fungsi toggle class
window.toggleClass = function (id, className) {
    const element = document.getElementById(id);
    element.classList.toggle(className);
};

// fungsi salin text
window.copyUrl = function (target, iconBefore, iconAfter) {
    navigator.clipboard.writeText(
        target.innerText || target.textContent || target.value,
    );
    iconBefore.classList.remove("inline-block");
    iconBefore.classList.add("hidden");
    iconAfter.classList.remove("hidden");
    iconAfter.classList.add("inline-block");
};

// ukuran textarea converter latin ke jawa
// agar ukuran dua textarea sama
window.converterHeight = function (base, result) {
    // reset ke 0
    base.style.height = result.style.height = "0px";
    // set autohight mengikuti ukuran tertinggi
    const baseHeight = base.scrollHeight;
    const resultHeight = result.scrollHeight;
    const height = Math.max(baseHeight, resultHeight);
    base.style.height = result.style.height = `${height}px`;
};
