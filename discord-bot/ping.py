TOKEN = 'MTEyNTgwMTY1MTQ1OTA3MjExMA.GXGgbR.HP2hbrx7VhC1ZcmjmYD8OTohPoXPzW_oxjFEdk'
import discord
from discord.ext import commands

intents = discord.Intents.default()
intents.message_content = True

bot = commands.Bot(command_prefix='!', intents=intents)

@bot.event
async def on_ready():
    print(f'Logged in as {bot.user.name}')
    print('------')

@bot.event
async def on_message(message):
    if message.guild.id == 1123971136611422210:  # Проверяем идентификатор сервера
        if str(message.content) == '@ParadiseRP#9788 Драйв':  # Проверяем сообщение
            role = discord.utils.get(message.guild.roles, id=1123971426387492955)  # Получаем роль по ID
            await message.author.add_roles(role)  # Добавляем роль пользователю

    await bot.process_commands(message)

bot.run(TOKEN)  # Замените на ваш токен бота