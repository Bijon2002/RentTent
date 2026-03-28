import pytest
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

# Optional helper for screenshots
import os

SCREENSHOT_DIR = os.path.join(os.getcwd(), "screenshots")
os.makedirs(SCREENSHOT_DIR, exist_ok=True)

def take_screenshot(driver, filename):
    path = os.path.join(SCREENSHOT_DIR, filename)
    driver.save_screenshot(path)
    print(f"📸 Screenshot saved: {path}")

# Login helper
def login(driver):
    driver.get("http://127.0.0.1:8000/login")
    wait = WebDriverWait(driver, 15)
    driver.find_element(By.NAME, "username").send_keys("admin")  # change creds
    driver.find_element(By.NAME, "password").send_keys("admin123")
    driver.find_element(By.ID, "login_btn").click()
    wait.until(EC.presence_of_element_located((By.XPATH, "//h1[contains(text(),'Dashboard')]")))
    take_screenshot(driver, "dashboard.png")

@pytest.mark.flaky(reruns=1)  # optional: retry once if fails
def test_properties_and_boardings(driver):
    wait = WebDriverWait(driver, 30)
    try:
        login(driver)

        # Open properties page
        driver.get("http://127.0.0.1:8000/properties")
        wait.until(EC.presence_of_element_located((By.XPATH, "//*[contains(text(), 'Properties')]")))
        take_screenshot(driver, "properties_page.png")

        # Get all boarding links
        boardings = driver.find_elements(By.XPATH, "//a[contains(@href,'/boarding/')]")
        boarding_urls = [b.get_attribute("href") for b in boardings]

        # Loop each boarding
        for idx, url in enumerate(boarding_urls, start=1):
            driver.get(url)
            wait.until(EC.presence_of_element_located((By.ID, "reserve_btn")))

            # Click Reserve
            reserve_btn = driver.find_element(By.ID, "reserve_btn")
            driver.execute_script("arguments[0].click();", reserve_btn)

            # Fill payment
            wait.until(EC.visibility_of_element_located((By.NAME, "cardholder_name"))).send_keys("John Doe")
            driver.find_element(By.NAME, "card_number").send_keys("4242424242424242")
            driver.find_element(By.NAME, "expiry").send_keys("12/34")
            driver.find_element(By.NAME, "cvc").send_keys("123")

            # Click Pay Now
            pay_btn = driver.find_element(By.ID, "pay_now")
            driver.execute_script("arguments[0].click();", pay_btn)

            # Wait for confirmation
            wait.until(EC.presence_of_element_located((By.XPATH, "//*[contains(text(), 'Booking Confirmed')]")))
            take_screenshot(driver, f"boarding_{idx}_confirmed.png")

    except Exception as e:
        take_screenshot(driver, "test_properties_fail.png")
        raise e
