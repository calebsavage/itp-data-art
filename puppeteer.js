const puppeteer = require('puppeteer')

async function getTimes(){
const browser = await puppeteer.launch()

const page = await browser.newPage()

await page.goto('https://nytimes.com')

await page.screenshot({path:'nytimes.png'})

await browser.close()

}

getTimes()
