from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from bs4 import BeautifulSoup
import pandas as pd
import time

# Path to your chromedriver
service = Service(r"C:\Users\hp\Desktop\chromedriver.exe")
options = webdriver.ChromeOptions()
options.add_argument("--headless")
driver = webdriver.Chrome(service=service, options=options)

base_url = "https://styleoutwatches.com/collections/rolex?page="

watches = []

for page in range(1, 6):  # Pages 1 to 5
    print(f"Scraping page {page}...")
    driver.get(base_url + str(page))
    time.sleep(2)

    soup = BeautifulSoup(driver.page_source, 'html.parser')
    products = soup.find_all('div', class_='spf-product-card__inner')

    for product in products:
        info_block = product.find_next('div', class_='spf-product__info')

        name_tag = info_block.find('a') if info_block else None
        name = name_tag.text.strip() if name_tag else 'N/A'
        link = 'https://styleoutwatches.com' + name_tag['href'] if name_tag else 'N/A'

        img_tag = product.find('img', class_='spf-product-card__image-main')
        image = img_tag['src'] if img_tag else 'N/A'

        watches.append({
            'Name': name,
            'Link': link,
            'Image': image,
            'Price': 'N/A'
        })

driver.quit()

# Save all data to CSV
df = pd.DataFrame(watches)
df.to_csv('Rolex_All.csv', index=False)
print(f"\n✅ Scraped {len(watches)} Rolex watches across all pages. Saved to Rolex_All.csv")
