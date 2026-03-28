import pytest
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
import os

# Screenshot folder
SCREENSHOT_DIR = os.path.join(os.getcwd(), "screenshots")
os.makedirs(SCREENSHOT_DIR, exist_ok=True)

@pytest.fixture
def driver():
    chrome_options = Options()
    chrome_options.add_argument("--start-maximized")
    chrome_options.add_argument("--disable-infobars")
    chrome_options.add_argument("--disable-extensions")
    chrome_options.add_argument("--disable-gpu")
    chrome_options.add_argument("--headless")  # remove if you want GUI
    driver = webdriver.Chrome(options=chrome_options)
    yield driver
    driver.quit()

@pytest.hookimpl(hookwrapper=True)
def pytest_runtest_makereport(item, call):
    # take screenshot on failure
    outcome = yield
    result = outcome.get_result()
    if result.when == "call" and result.failed:
        driver_fixture = item.funcargs.get("driver")
        if driver_fixture:
            screenshot_file = os.path.join(SCREENSHOT_DIR, f"{item.name}.png")
            driver_fixture.save_screenshot(screenshot_file)
            print(f"📸 Screenshot saved: {screenshot_file}")
